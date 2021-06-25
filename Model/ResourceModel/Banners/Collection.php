<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Model\ResourceModel\Banners;

/**
 * Class Collection
 * @package BoxLeafDigital\BannerSlider\Model\ResourceModel\Banners
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
            \BoxLeafDigital\BannerSlider\Model\Banners::class,
            \BoxLeafDigital\BannerSlider\Model\ResourceModel\Banners::class
        );
    }
}
