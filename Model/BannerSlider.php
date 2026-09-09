<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Model;

use CoullWorks\BannerSlider\Api\Data\BannerSliderInterface;
use Magento\Framework\Api\DataObjectHelper;
use CoullWorks\BannerSlider\Api\Data\BannerSliderInterfaceFactory;

/**
 * Class BannerSlider
 * @package CoullWorks\BannerSlider\Model
 */
class BannerSlider extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $_eventPrefix = 'coullworks_banner_slider_bannerslider';
    protected $bannersliderDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param BannerSliderInterfaceFactory $bannersliderDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \CoullWorks\BannerSlider\Model\ResourceModel\BannerSlider $resource
     * @param \CoullWorks\BannerSlider\Model\ResourceModel\BannerSlider\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        BannerSliderInterfaceFactory $bannersliderDataFactory,
        DataObjectHelper $dataObjectHelper,
        \CoullWorks\BannerSlider\Model\ResourceModel\BannerSlider $resource,
        \CoullWorks\BannerSlider\Model\ResourceModel\BannerSlider\Collection $resourceCollection,
        array $data = []
    ) {
        $this->bannersliderDataFactory = $bannersliderDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve bannerslider model with bannerslider data
     * @return BannerSliderInterface
     */
    public function getDataModel()
    {
        $bannersliderData = $this->getData();

        $bannersliderDataObject = $this->bannersliderDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $bannersliderDataObject,
            $bannersliderData,
            BannerSliderInterface::class
        );

        return $bannersliderDataObject;
    }
}
