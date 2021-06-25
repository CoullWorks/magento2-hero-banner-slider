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
 * Interface BannersRepositoryInterface
 * @package BoxLeafDigital\BannerSlider\Api
 */
interface BannersRepositoryInterface
{

    /**
     * Save Banners
     * @param \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface $banners
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface $banners
    );

    /**
     * Retrieve Banners
     * @param string $bannersId
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($bannersId);

    /**
     * Retrieve Banners matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Banners
     * @param \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface $banners
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface $banners
    );

    /**
     * Delete Banners by ID
     * @param string $bannersId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($bannersId);
}
