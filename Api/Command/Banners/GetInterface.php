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
 * Interface GetInterface
 * @package CoullWorks\BannerSlider\Api\Command\Banners
 */
interface GetInterface {

    /**
     * @param $bannersId
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute($bannersId);
}
