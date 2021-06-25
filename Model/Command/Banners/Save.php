<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Model\Command\Banners;

use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Exception\CouldNotSaveException;
use BoxLeafDigital\BannerSlider\Model\ResourceModel\Banners as ResourceBanners;
use BoxLeafDigital\BannerSlider\Model\BannersFactory ;

/**
 * Class Save
 * @package BoxLeafDigital\BannerSlider\Model\Command\Banners
 */
class Save implements \BoxLeafDigital\BannerSlider\Api\Command\Banners\SaveInterface {

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
     * @param \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface $banners
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     * @throws CouldNotSaveException
     */
    public function execute(
        \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface $banners
    ) {

        $bannersData = $this->_extensibleDataObjectConverter->toNestedArray(
            $banners,
            [],
            \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface::class
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
