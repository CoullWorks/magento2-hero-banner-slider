<?php
/**
 * CoullWorks Banner Slider for Magento 2.
 *
 * @author    danrcoull <ttechitsolutions@gmail.com>
 * @copyright Copyright (c) 2020-2026 CoullWorks
 * @license   Proprietary — see LICENSE.txt
 * @link      https://github.com/CoullWorks/magento2-hero-banner-slider
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Block\Widget;

use Magento\Framework\App\Area;
use Magento\Store\Model\ScopeInterface;

/**
 * Makes a widget block render nothing on the storefront when
 * Stores > Configuration > CoullWorks > Banner Slider > General > Enable is No.
 * Shared by the hero and slider blocks, and so by the Page Builder content types,
 * which render through the same widget directive. The admin (Page Builder stage
 * preview) is left alone so editors can still see what they are placing.
 */
trait ChecksModuleEnabled
{
    /**
     * @return bool
     */
    public function isModuleEnabled(): bool
    {
        if ($this->_appState->getAreaCode() === Area::AREA_ADMINHTML) {
            return true;
        }

        return $this->_scopeConfig->isSetFlag('banner_slider/general/enable', ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    protected function _toHtml()
    {
        return $this->isModuleEnabled() ? parent::_toHtml() : '';
    }
}
