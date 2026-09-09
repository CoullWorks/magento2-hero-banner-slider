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

namespace CoullWorks\BannerSlider\Test\Unit\Block\Widget;

use CoullWorks\BannerSlider\Block\Widget\BannerSlider;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;

class BannerSliderTest extends TestCase
{
    private BannerSlider $block;

    protected function setUp(): void
    {
        $this->block = (new ObjectManager($this))->getObject(
            BannerSlider::class,
            ['jsonSerializer' => new Json()]
        );
    }

    public function testGetClassReflectsLayoutFlags(): void
    {
        $this->block->setData(['full_width' => 1, 'is_parallax' => 1, 'full_height' => 1]);
        self::assertSame('full-width is-parallax full-height', $this->block->getClass());

        $this->block->unsetData();
        self::assertSame('', $this->block->getClass());
    }

    public function testGetImageClassTogglesParallax(): void
    {
        $this->block->setData('is_parallax', 1);
        self::assertStringContainsString('img-parallax', $this->block->getImageClass());

        $this->block->setData('is_parallax', 0);
        self::assertSame('', trim($this->block->getImageClass()));
    }

    public function testShowTabsReadsData(): void
    {
        $this->block->setData('show_tabs', 1);
        self::assertSame(1, $this->block->showTabs());
    }

    public function testSliderConfigDisablesArrowsAndNavsToTabsWhenTabsShown(): void
    {
        $this->block->setData('show_tabs', 1);
        $config = json_decode($this->block->getSliderConfig(), true);

        self::assertFalse($config['arrows']);
        self::assertSame('.tabs', $config['asNavFor']);
        self::assertTrue($config['autoplay']);
    }

    public function testSliderConfigShowsArrowsWithoutTabs(): void
    {
        $config = json_decode($this->block->getSliderConfig(), true);

        self::assertTrue($config['arrows']);
        self::assertArrayNotHasKey('asNavFor', $config);
    }

    public function testTabsConfigNavsToSlider(): void
    {
        $config = json_decode($this->block->getTabsConfig(), true);

        self::assertSame('.slider', $config['asNavFor']);
        self::assertSame(4, $config['slidesToShow']);
        self::assertTrue($config['focusOnSelect']);
    }
}
