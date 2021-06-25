<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace   BoxLeafDigital\BannerSlider\Api\Command\BannerSlider;

use BoxLeafDigital\BannerSlider\Api\Data\BannerSliderInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface GetListInterface
 * @package BoxLeafDigital\BannerSlider\Api\Command\BannerSlider
 */
interface GetListInterface {

    /**
     * @param SearchCriteriaInterface $criteria
     * @return BannerSliderInterface
     */
    public function execute(SearchCriteriaInterface $criteria);
}
