<?php
/**
 * CoullWorks Banner Slider for Magento 2.
 *
 * @author    danrcoull <ttechitsolutions@gmail.com>
 * @copyright Copyright (c) 2020-2026 CoullWorks
 * @license   Proprietary — see LICENSE.txt
 * @link      https://github.com/CoullWorks/magento2-hero-banner-slider
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Model\Image;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Magento\Framework\Image\AdapterFactory;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Resizes banner images to a target width and re-encodes them as WebP, caching the
 * result under media/banner/image/cache/. Used to keep hero/slider images small for
 * fast LCP. Every method degrades gracefully to the original image on any failure.
 */
class Optimizer
{
    private const CACHE_DIR = 'banner/image/cache';
    private const QUALITY = 82;

    /**
     * @var \Magento\Framework\Filesystem\Directory\WriteInterface
     */
    private $mediaDirectory;

    public function __construct(
        private readonly AdapterFactory $adapterFactory,
        private readonly Filesystem $filesystem,
        private readonly StoreManagerInterface $storeManager,
        private readonly LoggerInterface $logger
    ) {
        $this->mediaDirectory = $this->filesystem->getDirectoryWrite(DirectoryList::MEDIA);
    }

    /**
     * URL for an optimized copy of a stored banner image.
     *
     * @param string|null $relativePath e.g. "banner/image/hero.jpg"
     * @param int $width Target width in px (never upscaled).
     * @param string $format "webp" or "" to keep the original format.
     * @return string Absolute URL, or the original/empty on failure.
     */
    public function getUrl(?string $relativePath, int $width, string $format = 'webp'): string
    {
        $relativePath = ltrim((string) $relativePath, '/');
        if ($relativePath === '') {
            return '';
        }

        $original = $this->mediaBaseUrl() . $relativePath;

        try {
            if (!$this->mediaDirectory->isExist($relativePath)) {
                return $original;
            }

            $cacheRelative = $this->cachePath($relativePath, $width, $format);
            if (!$this->isUsableCache($cacheRelative, $format)) {
                $this->generate($relativePath, $cacheRelative, $width, $format);
            }

            return $this->mediaBaseUrl() . $cacheRelative;
        } catch (\Throwable $e) {
            $this->logger->warning('CoullWorks BannerSlider image optimize failed: ' . $e->getMessage());

            return $original;
        }
    }

    /**
     * Whether a cached file can be served. WebP files written by 2.0.0 and 2.0.1 were
     * really JPEG data with a .webp name, so those are regenerated.
     */
    private function isUsableCache(string $relative, string $format): bool
    {
        if (!$this->mediaDirectory->isExist($relative)) {
            return false;
        }
        if ($format !== 'webp') {
            return true;
        }

        $head = (string) file_get_contents($this->mediaDirectory->getAbsolutePath($relative), false, null, 0, 12);

        return strlen($head) === 12 && str_starts_with($head, 'RIFF') && substr($head, 8, 4) === 'WEBP';
    }

    /**
     * Generate the resized file. The image adapter always writes the source format
     * whatever the target extension is, so WebP is produced from the resized original
     * with GD or Imagick instead of being renamed.
     */
    private function generate(string $source, string $target, int $width, string $format): void
    {
        if ($format === 'webp') {
            $resized = $this->cachePath($source, $width, '');
            if (!$this->mediaDirectory->isExist($resized)) {
                $this->generate($source, $resized, $width, '');
            }
            $this->encodeWebp(
                $this->mediaDirectory->getAbsolutePath($resized),
                $this->mediaDirectory->getAbsolutePath($target)
            );

            return;
        }

        $this->mediaDirectory->create(dirname($target));

        $adapter = $this->adapterFactory->create();
        $adapter->open($this->mediaDirectory->getAbsolutePath($source));
        $adapter->constrainOnly(true);        // never upscale
        $adapter->keepAspectRatio(true);
        $adapter->quality(self::QUALITY);
        $adapter->resize($width, null);
        $adapter->save($this->mediaDirectory->getAbsolutePath($target));
    }

    /**
     * Re-encode an image file as real WebP.
     *
     * @throws \RuntimeException when neither GD nor Imagick can write WebP
     */
    private function encodeWebp(string $from, string $to): void
    {
        $this->mediaDirectory->create(dirname($this->mediaDirectory->getRelativePath($to)));

        if (function_exists('imagewebp')) {
            $image = imagecreatefromstring((string) file_get_contents($from));
            if ($image !== false) {
                imagepalettetotruecolor($image);
                imagealphablending($image, false);
                imagesavealpha($image, true);
                $written = imagewebp($image, $to, self::QUALITY);
                imagedestroy($image);
                if ($written) {
                    return;
                }
            }
        }

        if (class_exists(\Imagick::class) && in_array('WEBP', \Imagick::queryFormats('WEBP'), true)) {
            $imagick = new \Imagick($from);
            $imagick->setImageFormat('webp');
            $imagick->setImageCompressionQuality(self::QUALITY);
            $imagick->writeImage($to);
            $imagick->clear();

            return;
        }

        throw new \RuntimeException('No WebP encoder (GD imagewebp or Imagick) is available.');
    }

    /**
     * Cache path: banner/image/cache/<width>/<name>.<ext>
     */
    private function cachePath(string $relativePath, int $width, string $format): string
    {
        $name = pathinfo($relativePath, PATHINFO_FILENAME);
        $ext = $format === 'webp' ? 'webp' : (pathinfo($relativePath, PATHINFO_EXTENSION) ?: 'jpg');

        return self::CACHE_DIR . '/' . $width . '/' . $name . '.' . $ext;
    }

    private function mediaBaseUrl(): string
    {
        return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
}
