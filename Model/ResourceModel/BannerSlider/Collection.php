<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Model\ResourceModel\BannerSlider;

/**
 * Class Collection
 * @package CoullWorks\BannerSlider\Model\ResourceModel\BannerSlider
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
            \CoullWorks\BannerSlider\Model\BannerSlider::class,
            \CoullWorks\BannerSlider\Model\ResourceModel\BannerSlider::class
        );
    }
}
