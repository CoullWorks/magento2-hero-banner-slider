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
 * Interface BannersSearchResultsInterface
 * @package CoullWorks\BannerSlider\Api\Data
 */
interface BannersSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Banners list.
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface[]
     */
    public function getItems();

    /**
     * Set banner_name list.
     * @param \CoullWorks\BannerSlider\Api\Data\BannersInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
