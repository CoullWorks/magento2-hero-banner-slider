<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface BannersRepositoryInterface
 * @package CoullWorks\BannerSlider\Api
 */
interface BannersRepositoryInterface
{

    /**
     * Save Banners
     * @param \CoullWorks\BannerSlider\Api\Data\BannersInterface $banners
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \CoullWorks\BannerSlider\Api\Data\BannersInterface $banners
    );

    /**
     * Retrieve Banners
     * @param string $bannersId
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($bannersId);

    /**
     * Retrieve Banners matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \CoullWorks\BannerSlider\Api\Data\BannersSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Banners
     * @param \CoullWorks\BannerSlider\Api\Data\BannersInterface $banners
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \CoullWorks\BannerSlider\Api\Data\BannersInterface $banners
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
