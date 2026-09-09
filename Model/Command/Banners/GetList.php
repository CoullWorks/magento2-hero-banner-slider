<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Model\Command\Banners;

use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use CoullWorks\BannerSlider\Model\BannersFactory ;
use CoullWorks\BannerSlider\Api\Data\BannersSearchResultsInterfaceFactory;

use CoullWorks\BannerSlider\Model\ResourceModel\Banners\CollectionFactory as BannersCollectionFactory;

/**
 * Class GetList
 * @package CoullWorks\BannerSlider\Model\Command\Banners
 */
class GetList implements \CoullWorks\BannerSlider\Api\Command\Banners\GetListInterface {


    /**
     * @var BannersCollectionFactory
     */
    private $_bannersCollectionFactory;
    /**
     * @var JoinProcessorInterface
     */
    private $_extensionAttributesJoinProcessor;
    /**
     * @var CollectionProcessorInterface
     */
    private $_collectionProcessor;
    /**
     * @var BannersSearchResultsInterfaceFactory
     */
    private $_searchResultsFactory;


    /***
     * GetList constructor.
     * @param BannersCollectionFactory $bannersCollectionFactory
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param CollectionProcessorInterface $collectionProcessor
     * @param BannersSearchResultsInterfaceFactory $searchResultsFactory
     * @param BannersFactory $bannersFactory
     */
    public  function  __construct(
        BannersCollectionFactory $bannersCollectionFactory,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        CollectionProcessorInterface $collectionProcessor,
        BannersSearchResultsInterfaceFactory $searchResultsFactory,
        BannersFactory $bannersFactory
    )
    {
        $this->_bannersCollectionFactory = $bannersCollectionFactory;
        $this->_extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->_collectionProcessor = $collectionProcessor;
        $this->_searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface|\CoullWorks\BannerSlider\Api\Data\BannersSearchResultsInterface
     */
    public function execute(\Magento\Framework\Api\SearchCriteriaInterface $criteria) {

        $collection = $this->_bannersCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process(
            $collection,
            \CoullWorks\BannerSlider\Api\Data\BannersInterface::class
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
