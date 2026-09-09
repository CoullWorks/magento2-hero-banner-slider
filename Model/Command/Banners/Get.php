<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Model\Command\Banners;

use Magento\Framework\Exception\CouldNotSaveException;
use CoullWorks\BannerSlider\Model\ResourceModel\Banners as ResourceBanners;
use CoullWorks\BannerSlider\Model\BannersFactory ;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class Get
 * @package CoullWorks\BannerSlider\Model\Command\Banners
 */
class Get implements \CoullWorks\BannerSlider\Api\Command\Banners\GetInterface {

    /**
     * @var ResourceBanners
     */
    private $_resource;
    /**
     * @var BannersFactory
     */
    private $_bannersFactory;

    /**
     * Get constructor.
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
     * @param $bannersId
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface
     * @throws NoSuchEntityException
     */
    public function execute($bannersId) {

        $banners = $this->_bannersFactory->create();
        $this->_resource->load($banners, $bannersId);
        if (!$banners->getId()) {
            throw new NoSuchEntityException(__('Banners with id "%1" does not exist.', $bannersId));
        }
        return $banners->getDataModel();
    }
}
