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

use CoullWorks\BannerSlider\Block\Widget\HeroBanner;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;

class HeroBannerTest extends TestCase
{
    private HeroBanner $block;

    protected function setUp(): void
    {
        $this->block = (new ObjectManager($this))->getObject(HeroBanner::class);
    }

    public function testGetClassReflectsLayoutFlags(): void
    {
        $this->block->setData(['full_width' => 1, 'full_height' => 1]);
        self::assertSame('full-width full-height', $this->block->getClass());
    }

    public function testGetClassIsEmptyWithoutFlags(): void
    {
        self::assertSame('', $this->block->getClass());
    }

    public function testGetImageClassTogglesParallax(): void
    {
        $this->block->setData('is_parallax', 1);
        self::assertStringContainsString('img-parallax', $this->block->getImageClass());
    }

    public function testGetIdentitiesIncludesBannerId(): void
    {
        $this->block->setData('banner_id', 7);
        self::assertContains(HeroBanner::CACHE_TAG . '_7', $this->block->getIdentities());
    }
}
