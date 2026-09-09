<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Model;

use CoullWorks\BannerSlider\Api\Command\BannerSlider\DeleteByIdInterface;
use CoullWorks\BannerSlider\Api\Command\BannerSlider\DeleteInterface;
use CoullWorks\BannerSlider\Api\Command\BannerSlider\GetInterface;
use CoullWorks\BannerSlider\Api\Command\BannerSlider\GetListInterface;
use CoullWorks\BannerSlider\Api\Command\BannerSlider\SaveInterface;

use CoullWorks\BannerSlider\Api\BannerSliderRepositoryInterface;
use CoullWorks\BannerSlider\Api\Data\BannerSliderSearchResultsInterfaceFactory;
use CoullWorks\BannerSlider\Api\Data\BannerSliderInterfaceFactory;

/**
 * Class BannerSliderRepository
 * @package CoullWorks\BannerSlider\Model
 */
class BannerSliderRepository implements BannerSliderRepositoryInterface
{

    /**
     * @var GetInterface
     */
    private $_get;
    /**
     * @var DeleteByIdInterface
     */
    private $_deleteById;
    /**
     * @var DeleteInterface
     */
    private $_delete;
    /**
     * @var SaveInterface
     */
    private $_save;
    /**
     * @var GetListInterface
     */
    private $_getList;


    /**
     * @param GetInterface $get
     * @param DeleteByIdInterface $deleteById
     * @param DeleteInterface $delete
     * @param SaveInterface $save
     * @param GetListInterface $getList
     */
    public function __construct(
        GetInterface $get,
        DeleteByIdInterface $deleteById,
        DeleteInterface $delete,
        SaveInterface $save,
        GetListInterface $getList
    ) {
        $this->_get =$get;
        $this->_deleteById =$deleteById;
        $this->_delete =$delete;
        $this->_save =$save;
        $this->_getList =$getList;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \CoullWorks\BannerSlider\Api\Data\BannerSliderInterface $banners
    ) {
        return $this->_save->execute($banners);
    }

    /**
     * {@inheritdoc}
     */
    public function get($bannersId)
    {
        return $this->_get->execute($bannersId);
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        return $this->_getList->execute($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \CoullWorks\BannerSlider\Api\Data\BannerSliderInterface $banners
    ) {
        $this->_delete->execute($banners);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($bannersId)
    {
        $this->_deleteById->execute($bannersId);
    }
}
