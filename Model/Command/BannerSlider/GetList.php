<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Model\Command\BannerSlider;

use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use CoullWorks\BannerSlider\Model\BannerSliderFactory ;
use CoullWorks\BannerSlider\Api\Data\BannerSliderSearchResultsInterfaceFactory;

use CoullWorks\BannerSlider\Model\ResourceModel\BannerSlider\CollectionFactory as BannerSliderCollectionFactory;

/**
 * Class GetList
 * @package CoullWorks\BannerSlider\Model\Command\BannerSlider
 */
class GetList implements \CoullWorks\BannerSlider\Api\Command\BannerSlider\GetListInterface {


    /**
     * @var BannerSliderCollectionFactory
     */
    private $_bannerSliderCollectionFactory;
    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;
    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;
    /**
     * @var BannerSliderSearchResultsInterfaceFactory
     */
    private $_searchResultsFactory;


    /**
     * GetList constructor.
     * @param BannerSliderCollectionFactory $bannerSliderCollectionFactory
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param CollectionProcessorInterface $collectionProcessor
     * @param BannerSliderSearchResultsInterfaceFactory $searchResultsFactory
     * @param BannerSliderFactory $bannerSliderFactory
     */
    public  function  __construct(
        BannerSliderCollectionFactory $bannerSliderCollectionFactory,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        CollectionProcessorInterface $collectionProcessor,
        BannerSliderSearchResultsInterfaceFactory $searchResultsFactory,
        BannerSliderFactory $bannerSliderFactory
    )
    {
        $this->_bannerSliderCollectionFactory = $bannerSliderCollectionFactory;
        $this->_extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->_collectionProcessor = $collectionProcessor;
        $this->_searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \CoullWorks\BannerSlider\Api\Data\BannerSliderInterface|\CoullWorks\BannerSlider\Api\Data\BannerSliderSearchResultsInterface
     */
    public function execute(\Magento\Framework\Api\SearchCriteriaInterface $criteria) {

        $collection = $this->_bannerSliderCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process(
            $collection,
            \CoullWorks\BannerSlider\Api\Data\BannerSliderInterface::class
        );

        $this->_collectionProcessor->process($criteria, $collection);

        $searchResults = $this->_searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
