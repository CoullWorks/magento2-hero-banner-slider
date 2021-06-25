<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace  BoxLeafDigital\BannerSlider\Api\Command\BannerSlider;

use BoxLeafDigital\BannerSlider\Api\Data\BannerSliderInterface;

/**
 * Interface SaveInterface
 * @package BoxLeafDigital\BannerSlider\Api\Command\BannerSlider
 */
interface SaveInterface {

    /**
     * @param BannerSliderInterface $bannerSlider
     * @return BannerSliderInterface
     */
    public function execute(BannerSliderInterface $bannerSlider);
}
