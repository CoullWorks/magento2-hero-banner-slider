<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace   BoxLeafDigital\BannerSlider\Api\Command\BannerSlider;


use BoxLeafDigital\BannerSlider\Api\Data\BannerSliderInterface;

/**
 * Interface DeleteByIdInterface
 * @package BoxLeafDigital\BannerSlider\Api\Command\BannerSlider
 */
interface DeleteByIdInterface {

    /**
     * @param $bannersId
     * @return BannerSliderInterface
     */
    public function execute($bannersId);
}
