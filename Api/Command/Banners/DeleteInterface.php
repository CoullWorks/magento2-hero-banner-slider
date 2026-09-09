<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace   CoullWorks\BannerSlider\Api\Command\Banners;

/**
 * Interface DeleteInterface
 * @package CoullWorks\BannerSlider\Api\Command\Banners
 */
interface DeleteInterface {

    /**
     * @param \CoullWorks\BannerSlider\Api\Data\BannersInterface $banners
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface
     */
    public function execute(\CoullWorks\BannerSlider\Api\Data\BannersInterface $banners);
}
