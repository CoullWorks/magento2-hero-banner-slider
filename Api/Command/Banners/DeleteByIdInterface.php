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
 * Interface DeleteByIdInterface
 * @package CoullWorks\BannerSlider\Api\Command\Banners
 */
interface DeleteByIdInterface {

    /**
     * @param $bannersId
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface
     */
    public function execute($bannersId);
}
