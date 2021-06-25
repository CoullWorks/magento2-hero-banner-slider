<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Model\Command\Banners;

use Magento\Framework\Exception\CouldNotSaveException;
use BoxLeafDigital\BannerSlider\Model\ResourceModel\Banners as ResourceBanners;
use BoxLeafDigital\BannerSlider\Model\BannersFactory ;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class Get
 * @package BoxLeafDigital\BannerSlider\Model\Command\Banners
 */
class Get implements \BoxLeafDigital\BannerSlider\Api\Command\Banners\GetInterface {

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
     * @return \BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
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
