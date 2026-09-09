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
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface GetListInterface
 * @package CoullWorks\BannerSlider\Api\Command\BannerSlider
 */
interface GetListInterface {

    /**
     * @param SearchCriteriaInterface $criteria
     * @return BannerSliderInterface
     */
    public function execute(SearchCriteriaInterface $criteria);
}
