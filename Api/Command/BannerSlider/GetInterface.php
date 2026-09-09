<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace   CoullWorks\BannerSlider\Api\Command\BannerSlider;

use CoullWorks\BannerSlider\Api\Data\BannerSliderInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Interface GetInterface
 * @package CoullWorks\BannerSlider\Api\Command\BannerSlider
 */
interface GetInterface {

    /**
     * @param $bannerSliderId
     * @return BannerSliderInterface
     * @throws LocalizedException
     */
    public function execute($bannerSliderId);
}
