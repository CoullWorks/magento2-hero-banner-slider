<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Model\Data;

use BoxLeafDigital\BannerSlider\Api\Data\BannersInterface;
use Magento\Framework\Api\AttributeValueFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Banners
 * @package BoxLeafDigital\BannerSlider\Model\Data
 */
class Banners extends \Magento\Framework\Api\AbstractExtensibleObject implements BannersInterface
{


    /**
     * @var StoreManagerInterface
     */
    private $_storeManager;

    public function __construct(
        StoreManagerInterface $storeManager,
        \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
        \Magento\Framework\Api\AttributeValueFactory $attributeValueFactory, $data = [])
    {
        parent::__construct($extensionFactory, $attributeValueFactory, $data);

        $this->_storeManager = $storeManager;
    }

    /**
     * Get banners_id
     * @return string|null
     */
    public function getBannersId()
    {
        return $this->_get(self::BANNERS_ID);
    }

    /**
     * Set banners_id
     * @param string $bannersId
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     */
    public function setBannersId($bannersId)
    {
        return $this->setData(self::BANNERS_ID, $bannersId);
    }


    /**
     * Get enabled
     * @return boolean|null
     */
    public function getEnabled()
    {
        return $this->_get(self::ENABLED);
    }

    /**
     * Set enabled
     * @param string $bannerEnabled
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     */
    public function setEnabled($bannerEnabled)
    {
        return $this->setData(self::ENABLED, $bannerEnabled);
    }

    /**
     * Get banner_name
     * @return string|null
     */
    public function getBannerName()
    {
        return $this->_get(self::BANNER_NAME);
    }

    /**
     * Set banner_name
     * @param string $bannerName
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     */
    public function setBannerName($bannerName)
    {
        return $this->setData(self::BANNER_NAME, $bannerName);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \BoxLeafDigital\BannerSlider\Api\Data\BannersExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \BoxLeafDigital\BannerSlider\Api\Data\BannersExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get show_banner_overlay
     * @return string|null
     */
    public function getShowBannerOverlay()
    {
        return $this->_get(self::SHOW_BANNER_OVERLAY);
    }

    /**
     * Set show_banner_overlay
     * @param string $showBannerOverlay
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     */
    public function setShowBannerOverlay($showBannerOverlay)
    {
        return $this->setData(self::SHOW_BANNER_OVERLAY, $showBannerOverlay);
    }

    /**
     * Get banner_overlay_content
     * @return string|null
     */
    public function getBannerOverlayContent()
    {
        return $this->_get(self::BANNER_OVERLAY_CONTENT);
    }

    /**
     * Set banner_overlay_content
     * @param string $bannerOverlayContent
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     */
    public function setBannerOverlayContent($bannerOverlayContent)
    {
        return $this->setData(self::BANNER_OVERLAY_CONTENT, $bannerOverlayContent);
    }

    /**
     * Get banner_image
     * @return string|null
     */
    public function getBannerImage()
    {
        return $this->_get(self::BANNER_IMAGE);
    }

    /**
     * Set banner_image
     * @param string $bannerImage
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     */
    public function setBannerImage($bannerImage)
    {
        return $this->setData(self::BANNER_IMAGE, $bannerImage);
    }

    /**
     * Get banner_image_mobile
     * @return string|null
     */
    public function getBannerImageMobile()
    {
        return $this->_get(self::BANNER_IMAGE_MOBILE);
    }

    /**
     * Set banner_image_mobile
     * @param string $bannerImageMobile
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     */
    public function setBannerImageMobile($bannerImageMobile)
    {
        return $this->setData(self::BANNER_IMAGE_MOBILE, $bannerImageMobile);
    }

    /**
     * @param string $attributeCode
     * @return bool|string
     * @throws NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getImageUrl($attributeCode = 'banner_image')
    {
        $url = false;
        $image = $this->_get($attributeCode);
        if ($image) {
            if (is_string($image)) {
                $store = $this->_storeManager->getStore();
                $isRelativeUrl = substr($image, 0, 1) === '/';

                $mediaBaseUrl = $store->getBaseUrl(
                    \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                );

                if ($isRelativeUrl) {
                    $url = $image;
                } else {
                    $url = $mediaBaseUrl
                        . $image;
                }
            } else {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Something went wrong while getting the image url.')
                );
            }
        }
        return $url;
    }

    /**
     * Get banner_link
     * @return string|null
     */
    public function getBannerLink()
    {
        return $this->_get(self::BANNER_LINK);
    }

    /**
     * Set banner_link
     * @param $bannerLink
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     */
    public function setBannerLink($bannerLink)
    {
        return $this->setData(self::BANNER_LINK, $bannerLink);
    }
}
