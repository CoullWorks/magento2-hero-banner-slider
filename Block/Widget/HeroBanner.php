<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Block\Widget;

use CoullWorks\BannerSlider\Api\BannerSliderRepositoryInterface;
use CoullWorks\BannerSlider\Api\BannersRepositoryInterface;
use CoullWorks\BannerSlider\Model\Image\Optimizer;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

/**
 * Class HeroBanner
 * @package CoullWorks\BannerSlider\Block\Widget
 */
class HeroBanner extends Template implements IdentityInterface
{


    const CACHE_TAG = 'banner_h';

    protected $_cacheTag = self::CACHE_TAG;

    protected $_template = "banner/hero.phtml";
    /**
     * @var BannerSliderRepositoryInterface
     */
    private $bannerSliderRepository;
    /**
     * @var SearchCriteriaBuilderFactory
     */
    private $searchCriteriaBuilderFactory;
    /**
     * @var BannersRepositoryInterface
     */
    private $bannersRepository;
    /**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    private $contentProcessor;

    /**
     * HeroBanner constructor.
     * @param BannerSliderRepositoryInterface $bannerSliderRepository
     * @param BannersRepositoryInterface $bannersRepository
     * @param SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
     * @param \Magento\Cms\Model\Template\FilterProvider $contentProcessor
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        BannerSliderRepositoryInterface $bannerSliderRepository,
        BannersRepositoryInterface $bannersRepository,
        SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
        \Magento\Cms\Model\Template\FilterProvider $contentProcessor,
        Optimizer $optimizer,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->bannerSliderRepository = $bannerSliderRepository;
        $this->bannersRepository = $bannersRepository;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->contentProcessor = $contentProcessor;
        $this->optimizer = $optimizer;
    }

    /**
     * @var Optimizer
     */
    private $optimizer;

    /**
     * Optimized (resized + optionally WebP) URL for a stored banner image path.
     *
     * @param string|null $path
     * @param int $width
     * @param string $format
     * @return string
     */
    public function getOptimizedUrl(?string $path, int $width, string $format = 'webp'): string
    {
        return $this->optimizer->getUrl($path, $width, $format);
    }

    /**
     * @return string
     */
    public function getImageClass()
    {
        $class ='';

        if ($this->getData('is_parallax')) {
            $class  .= 'img-parallax ';
        }
        return $class;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        $class =[];

        if ($this->getData('full_width')) {
            $class[]= 'full-width';
        }

        if ($this->getData('is_parallax')) {
            $class[]= 'is-parallax';
        }

        if ($this->getData('full_height')) {
            $class[]= 'full-height';
        }

        return implode(' ', $class);
    }

    /**
     * @return bool|\CoullWorks\BannerSlider\Api\Data\BannersInterface
     */
    public function getSlide()
    {
        try {
            return $this->bannersRepository->get($this->getData('banner_id'));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param $content
     * @return string
     * @throws \Exception
     */
    public function processContent($content)
    {
        return $this->contentProcessor->getPageFilter()->filter($content);
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [$this->_cacheTag . '_' . $this->getData('banner_id')];
    }
}
