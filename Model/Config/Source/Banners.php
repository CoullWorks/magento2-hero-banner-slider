<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Model\Config\Source;

use CoullWorks\BannerSlider\Api\BannersRepositoryInterface;
use CoullWorks\BannerSlider\Api\Data\BannersInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Banners
 * @package CoullWorks\BannerSlider\Model\Source\Config
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
     * Enabled banners only, so the Slides list and the Page Builder picker match the notice shown above them.
     *
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function toOptionArray()
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(BannersInterface::ENABLED, 1)
            ->create();
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
