<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Model\ResourceModel\Banners;

/**
 * Class Collection
 * @package CoullWorks\BannerSlider\Model\ResourceModel\Banners
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \CoullWorks\BannerSlider\Model\Banners::class,
            \CoullWorks\BannerSlider\Model\ResourceModel\Banners::class
        );
    }
}
