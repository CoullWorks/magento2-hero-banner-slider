<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace   BoxLeafDigital\BannerSlider\Api\Command\BannerSlider;

use BoxLeafDigital\BannerSlider\Api\Data\BannerSliderInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Interface GetInterface
 * @package BoxLeafDigital\BannerSlider\Api\Command\BannerSlider
 */
interface GetInterface {

    /**
     * @param $bannerSliderId
     * @return BannerSliderInterface
     * @throws LocalizedException
     */
    public function execute($bannerSliderId);
}
