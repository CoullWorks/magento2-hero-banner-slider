<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Model\Config\Source;

use BoxLeafDigital\BannerSlider\Api\BannerSliderRepositoryInterface;
use BoxLeafDigital\BannerSlider\Api\BannersRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Banners
 * @package BoxLeafDigital\BannerSlider\Model\Source\Config
 */
class BannerSlider implements OptionSourceInterface {

    /**
     * @var BannerSliderRepositoryInterface
     */
    private $_bannerSliderRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * Banners constructor.
     * @param BannerSliderRepositoryInterface $bannersRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(BannerSliderRepositoryInterface $bannersRepository,
                                SearchCriteriaBuilder $searchCriteriaBuilder)
    {
        $this->_bannerSliderRepository = $bannersRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function toOptionArray()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
       $items = $this->_bannerSliderRepository->getList($searchCriteria);
       $options = [];
       if($items->getTotalCount() > 0)
       {
           foreach ($items->getItems() as $item) {
              $options[] = [
                  'label' => $item->getSliderName(),
                  'value' => $item->getBannersliderId()
                  ];
           }
       }

        return $options;
    }

}
