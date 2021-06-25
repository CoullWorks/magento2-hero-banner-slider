<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Api\Data;

/**
 * Interface BannersInterface
 * @package BoxLeafDigital\BannerSlider\Api\Data
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
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
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
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
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
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     */
    public function setBannerName($bannerName);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \BoxLeafDigital\BannerSlider\Api\Data\BannersExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \BoxLeafDigital\BannerSlider\Api\Data\BannersExtensionInterface $extensionAttributes
    );

    /**
     * Get show_banner_overlay
     * @return string|null
     */
    public function getShowBannerOverlay();

    /**
     * Set show_banner_overlay
     * @param string $showBannerOverlay
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
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
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
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
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
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
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     */
    public function setBannerImageMobile($bannerImageMobile);

    /**
     * Set banner_link
     * @param string $bannerLink
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     */
    public function setBannerLink($bannerLink);

    /**
     * Get banner_link
     * @return string|null
     */
    public function getBannerLink();
}
