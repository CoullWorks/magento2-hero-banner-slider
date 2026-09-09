<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Model\Command\BannerSlider;



use CoullWorks\BannerSlider\Api\Data\BannerSliderInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class DeleteById
 * @package CoullWorks\BannerSlider\Model\Command\BannerSlider
 */
class DeleteById implements \CoullWorks\BannerSlider\Api\Command\BannerSlider\DeleteByIdInterface {


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
