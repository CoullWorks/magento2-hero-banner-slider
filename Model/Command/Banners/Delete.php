<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Model\Command\Banners;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use BoxLeafDigital\BannerSlider\Model\ResourceModel\Banners as ResourceBanners;
use BoxLeafDigital\BannerSlider\Model\BannersFactory ;
use Magento\Framework\Exception\NoSuchEntityException;


/**
 * Class Delete
 * @package BoxLeafDigital\BannerSlider\Model\Command\Banners
 */
class Delete implements \BoxLeafDigital\BannerSlider\Api\Command\Banners\DeleteInterface {

    /**
     * @var BannersFactory
     */
    private $_bannersFactory;
    /**
     * @var ResourceBanners
     */
    private $_resource;

    /**
     * Delete constructor.
     * @param BannersFactory $bannersFactory
     * @param ResourceBanners $resource
     */
    public  function  __construct(
        BannersFactory $bannersFactory,
        ResourceBanners $resource
    )
    {
        $this->_bannersFactory = $bannersFactory;
        $this->_resource = $resource;
    }

    /**
     * @param \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface $banners
     * @return bool|\BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     * @throws CouldNotDeleteException
     */
    public function execute(
        \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface $banners
    ) {

        try {
            $bannersModel = $this->_bannersFactory->create();
            $this->_resource->load($bannersModel, $banners->getBannersId());
            $this->_resource->delete($bannersModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Banners: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }
}
