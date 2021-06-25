<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Model\Config\Source;

use BoxLeafDigital\BannerSlider\Api\BannersRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Banners
 * @package BoxLeafDigital\BannerSlider\Model\Source\Config
 */
class Banners implements OptionSourceInterface {

    /**
     * @var BannersRepositoryInterface
     */
    private $_bannersRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * Banners constructor.
     * @param BannersRepositoryInterface $bannersRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(BannersRepositoryInterface $bannersRepository,
                                SearchCriteriaBuilder $searchCriteriaBuilder)
    {
        $this->_bannersRepository = $bannersRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function toOptionArray()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
       $items = $this->_bannersRepository->getList($searchCriteria);
       $options = [];
       if($items->getTotalCount() > 0)
       {
           foreach ($items->getItems() as $item) {
              $options[] = [
                  'label' => $item->getBannerName(),
                  'value' => $item->getBannersId()
              ];
           }
       }

        return $options;
    }

}
