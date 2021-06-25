<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Api\Data;

/**
 * Interface BannerSliderSearchResultsInterface
 * @package BoxLeafDigital\BannerSlider\Api\Data
 */
interface BannerSliderSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get BannerSlider list.
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannerSliderInterface[]
     */
    public function getItems();

    /**
     * Set slider_name list.
     * @param \BoxLeafDigital\BannerSlider\Api\Data\BannerSliderInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
