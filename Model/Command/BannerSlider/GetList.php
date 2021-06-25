<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Model\Command\BannerSlider;

use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use BoxLeafDigital\BannerSlider\Model\BannerSliderFactory ;
use BoxLeafDigital\BannerSlider\Api\Data\BannerSliderSearchResultsInterfaceFactory;

use BoxLeafDigital\BannerSlider\Model\ResourceModel\BannerSlider\CollectionFactory as BannerSliderCollectionFactory;

/**
 * Class GetList
 * @package BoxLeafDigital\BannerSlider\Model\Command\BannerSlider
 */
class GetList implements \BoxLeafDigital\BannerSlider\Api\Command\BannerSlider\GetListInterface {


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
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannerSliderInterface|\BoxLeafDigital\BannerSlider\Api\Data\BannerSliderSearchResultsInterface
     */
    public function execute(\Magento\Framework\Api\SearchCriteriaInterface $criteria) {

        $collection = $this->_bannerSliderCollectionFactory->create();

        $this->_extensionAttributesJoinProcessor->process(
            $collection,
            \BoxLeafDigital\BannerSlider\Api\Data\BannerSliderInterface::class
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
