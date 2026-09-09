<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Api\Data;

/**
 * Interface BannerSliderSearchResultsInterface
 * @package CoullWorks\BannerSlider\Api\Data
 */
interface BannerSliderSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get BannerSlider list.
     * @return \CoullWorks\BannerSlider\Api\Data\BannerSliderInterface[]
     */
    public function getItems();

    /**
     * Set slider_name list.
     * @param \CoullWorks\BannerSlider\Api\Data\BannerSliderInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
