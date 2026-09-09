<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Model\Command\Banners;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use CoullWorks\BannerSlider\Model\ResourceModel\Banners as ResourceBanners;
use CoullWorks\BannerSlider\Model\BannersFactory ;
use Magento\Framework\Exception\NoSuchEntityException;


/**
 * Class Delete
 * @package CoullWorks\BannerSlider\Model\Command\Banners
 */
class Delete implements \CoullWorks\BannerSlider\Api\Command\Banners\DeleteInterface {

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
     * @param \CoullWorks\BannerSlider\Api\Data\BannersInterface $banners
     * @return bool|\CoullWorks\BannerSlider\Api\Data\BannersInterface
     * @throws CouldNotDeleteException
     */
    public function execute(
        \CoullWorks\BannerSlider\Api\Data\BannersInterface $banners
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
