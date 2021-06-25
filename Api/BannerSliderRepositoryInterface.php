<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface BannerSliderRepositoryInterface
 * @package BoxLeafDigital\BannerSlider\Api
 */
interface BannerSliderRepositoryInterface
{

    /**
     * Save BannerSlider
     * @param \BoxLeafDigital\BannerSlider\Api\Data\BannerSliderInterface $bannerSlider
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannerSliderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \BoxLeafDigital\BannerSlider\Api\Data\BannerSliderInterface $bannerSlider
    );

    /**
     * Retrieve BannerSlider
     * @param string $bannersliderId
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannerSliderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($bannersliderId);

    /**
     * Retrieve BannerSlider matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannerSliderSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete BannerSlider
     * @param \BoxLeafDigital\BannerSlider\Api\Data\BannerSliderInterface $bannerSlider
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \BoxLeafDigital\BannerSlider\Api\Data\BannerSliderInterface $bannerSlider
    );

    /**
     * Delete BannerSlider by ID
     * @param string $bannersliderId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($bannersliderId);
}
