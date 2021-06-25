<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Model\Command\BannerSlider;



use BoxLeafDigital\BannerSlider\Api\Data\BannerSliderInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class DeleteById
 * @package BoxLeafDigital\BannerSlider\Model\Command\BannerSlider
 */
class DeleteById implements \BoxLeafDigital\BannerSlider\Api\Command\BannerSlider\DeleteByIdInterface {


    /**
     * @var Get
     */
    private $_get;
    /**
     * @var Delete
     */
    private $_delete;

    /**
     * DeleteById constructor.
     * @param Get $get
     * @param Delete $delete
     */
    public  function  __construct(
        Get $get,
        Delete $delete
    )
    {
        $this->_get = $get;
        $this->_delete = $delete;
    }

    /**
     * @param $bannerSliderId
     * @return bool|BannerSliderInterface
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function execute($bannerSliderId
    )
    {
        $bannerSliderModel = $this->_get->execute($bannerSliderId);
        return $this->_delete->execute($bannerSliderModel);
    }
}
