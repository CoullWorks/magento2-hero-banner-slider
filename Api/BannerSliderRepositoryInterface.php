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
 * Interface BannerSliderRepositoryInterface
 * @package CoullWorks\BannerSlider\Api
 */
interface BannerSliderRepositoryInterface
{

    /**
     * Save BannerSlider
     * @param \CoullWorks\BannerSlider\Api\Data\BannerSliderInterface $bannerSlider
     * @return \CoullWorks\BannerSlider\Api\Data\BannerSliderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \CoullWorks\BannerSlider\Api\Data\BannerSliderInterface $bannerSlider
    );

    /**
     * Retrieve BannerSlider
     * @param string $bannersliderId
     * @return \CoullWorks\BannerSlider\Api\Data\BannerSliderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($bannersliderId);

    /**
     * Retrieve BannerSlider matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \CoullWorks\BannerSlider\Api\Data\BannerSliderSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete BannerSlider
     * @param \CoullWorks\BannerSlider\Api\Data\BannerSliderInterface $bannerSlider
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \CoullWorks\BannerSlider\Api\Data\BannerSliderInterface $bannerSlider
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
