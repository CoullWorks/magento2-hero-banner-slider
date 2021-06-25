<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Model\Command\Banners;

use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use BoxLeafDigital\BannerSlider\Model\BannersFactory ;
use BoxLeafDigital\BannerSlider\Api\Data\BannersSearchResultsInterfaceFactory;

use BoxLeafDigital\BannerSlider\Model\ResourceModel\Banners\CollectionFactory as BannersCollectionFactory;

/**
 * Class GetList
 * @package BoxLeafDigital\BannerSlider\Model\Command\Banners
 */
class GetList implements \BoxLeafDigital\BannerSlider\Api\Command\Banners\GetListInterface {


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
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface|\BoxLeafDigital\BannerSlider\Api\Data\BannersSearchResultsInterface
     */
    public function execute(\Magento\Framework\Api\SearchCriteriaInterface $criteria) {

        $collection = $this->_bannersCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process(
            $collection,
            \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface::class
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
