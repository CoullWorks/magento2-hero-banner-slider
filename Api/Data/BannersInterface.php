<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Api\Data;

/**
 * Interface BannersInterface
 * @package CoullWorks\BannerSlider\Api\Data
 */
interface BannersInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const BANNERS_ID = 'banners_id';
    const BANNER_IMAGE_MOBILE = 'banner_image_mobile';
    const SHOW_BANNER_OVERLAY = 'show_banner_overlay';
    const BANNER_OVERLAY_CONTENT = 'banner_overlay_content';
    const BANNER_IMAGE = 'banner_image';
    const BANNER_NAME = 'banner_name';
    const BANNER_LINK = 'banner_link';
    const ENABLED = 'enabled';

    /**
     * Get banners_id
     * @return string|null
     */
    public function getBannersId();

    /**
     * Set banners_id
     * @param string $bannersId
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface
     */
    public function setBannersId($bannersId);

    /**
     * Get enabled
     * @return boolean|null
     */
    public function getEnabled();

    /**
     * Set enabled
     * @param string $bannerEnabled
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface
     */
    public function setEnabled($bannerEnabled);

    /**
     * Get banner_name
     * @return string|null
     */
    public function getBannerName();

    /**
     * Set banner_name
     * @param string $bannerName
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface
     */
    public function setBannerName($bannerName);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \CoullWorks\BannerSlider\Api\Data\BannersExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \CoullWorks\BannerSlider\Api\Data\BannersExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \CoullWorks\BannerSlider\Api\Data\BannersExtensionInterface $extensionAttributes
    );

    /**
     * Get show_banner_overlay
     * @return string|null
     */
    public function getShowBannerOverlay();

    /**
     * Set show_banner_overlay
     * @param string $showBannerOverlay
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface
     */
    public function setShowBannerOverlay($showBannerOverlay);

    /**
     * Get banner_overlay_content
     * @return string|null
     */
    public function getBannerOverlayContent();

    /**
     * Set banner_overlay_content
     * @param string $bannerOverlayContent
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface
     */
    public function setBannerOverlayContent($bannerOverlayContent);

    /**
     * Get banner_image
     * @return string|null
     */
    public function getBannerImage();

    /**
     * Set banner_image
     * @param string $bannerImage
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface
     */
    public function setBannerImage($bannerImage);

    /**
     * Get banner_image_mobile
     * @return string|null
     */
    public function getBannerImageMobile();

    /**
     * Set banner_image_mobile
     * @param string $bannerImageMobile
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface
     */
    public function setBannerImageMobile($bannerImageMobile);

    /**
     * Set banner_link
     * @param string $bannerLink
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface
     */
    public function setBannerLink($bannerLink);

    /**
     * Get banner_link
     * @return string|null
     */
    public function getBannerLink();
}
