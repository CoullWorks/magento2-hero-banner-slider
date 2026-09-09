<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Model\Command\BannerSlider;

use CoullWorks\BannerSlider\Api\Command\BannerSlider\GetInterface;

use CoullWorks\BannerSlider\Api\Data\BannerSliderInterface;
use CoullWorks\BannerSlider\Model\ResourceModel\BannerSlider as ResourceBannerSlider;
use CoullWorks\BannerSlider\Model\BannerSliderFactory ;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class Get
 * @package CoullWorks\BannerSlider\Model\Command\BannerSlider
 */
class Get implements GetInterface {

    /**
     * @var ResourceBannerSlider
     */
    private $_resource;
    /**
     * @var BannerSliderFactory
     */
    private $_bannerSliderFactory;


    public  function  __construct(
        BannerSliderFactory $bannerSliderFactory,
        ResourceBannerSlider $resource
    )
    {
        $this->_bannerSliderFactory = $bannerSliderFactory;
        $this->_resource = $resource;
    }

    /**
     * @param $bannerSliderId
     * @return BannerSliderInterface
     * @throws NoSuchEntityException
     */
    public function execute($bannerSliderId) {

        $bannerSlider = $this->_bannerSliderFactory->create();
        $this->_resource->load($bannerSlider, $bannerSliderId);
        if (!$bannerSlider->getId()) {
            throw new NoSuchEntityException(__('BannerSlider with id "%1" does not exist.', $bannerSliderId));
        }
        return $bannerSlider->getDataModel();
    }
}
