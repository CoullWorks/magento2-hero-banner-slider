<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Model\Command\Banners;

use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Exception\CouldNotSaveException;
use CoullWorks\BannerSlider\Model\ResourceModel\Banners as ResourceBanners;
use CoullWorks\BannerSlider\Model\BannersFactory ;

/**
 * Class Save
 * @package CoullWorks\BannerSlider\Model\Command\Banners
 */
class Save implements \CoullWorks\BannerSlider\Api\Command\Banners\SaveInterface {

    /**
     * @var ExtensibleDataObjectConverter
     */
    private $_extensibleDataObjectConverter;
    /**
     * @var BannersFactory
     */
    private $_bannersFactory;
    /**
     * @var ResourceBanners
     */
    private $_resource;

    /**
     * Save constructor.
     * @param BannersFactory $bannersFactory
     * @param ResourceBanners $resource
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public  function  __construct(
        BannersFactory $bannersFactory,
        ResourceBanners $resource,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter)
    {
        $this->_extensibleDataObjectConverter = $extensibleDataObjectConverter;
        $this->_bannersFactory = $bannersFactory;
        $this->_resource = $resource;
    }

    /**
     * @param \CoullWorks\BannerSlider\Api\Data\BannersInterface $banners
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface
     * @throws CouldNotSaveException
     */
    public function execute(
        \CoullWorks\BannerSlider\Api\Data\BannersInterface $banners
    ) {

        $bannersData = $this->_extensibleDataObjectConverter->toNestedArray(
            $banners,
            [],
            \CoullWorks\BannerSlider\Api\Data\BannersInterface::class
        );

        $bannersModel = $this->_bannersFactory->create()->setData($bannersData);

        try {
            $this->_resource->save($bannersModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the banners: %1',
                $exception->getMessage()
            ));
        }
        return $bannersModel->getDataModel();
    }
}
