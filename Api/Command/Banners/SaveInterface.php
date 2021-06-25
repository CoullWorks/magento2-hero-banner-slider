<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace  BoxLeafDigital\BannerSlider\Api\Command\Banners;

/**
 * Interface SaveInterface
 * @package BoxLeafDigital\BannerSlider\Api\Command\Banners
 */
interface SaveInterface {

    /**
     * @param \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface $banners
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     */
    public function execute(\BoxLeafDigital\BannerSlider\Api\Data\BannersInterface $banners);
}
