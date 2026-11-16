<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Block\Widget;

use CoullWorks\BannerSlider\Api\BannerSliderRepositoryInterface;
use CoullWorks\BannerSlider\Api\BannersRepositoryInterface;
use CoullWorks\BannerSlider\Api\Data\BannerSliderInterface;
use CoullWorks\BannerSlider\Model\Image\Optimizer;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

/**
 * Class BannerSlider
 * @package CoullWorks\BannerSlider\Block\Widget
 */
class BannerSlider extends Template implements IdentityInterface, BlockInterface
{
    use ChecksModuleEnabled;

    const CACHE_TAG = 'banner_s';

    /**
     * Cache tag shared with the banner model, so editing a banner refreshes the
     * cached page of every slider that contains it.
     */
    public const BANNER_CACHE_TAG = 'banner_b';

    /**
     * @var string|null
     */
    private $htmlId;

    /**
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    protected $_template = "banner/slider.phtml";
    /**
     * @var BannerSliderRepositoryInterface
     */
    private $bannerSliderRepository;
    /**
     * @var SearchCriteriaBuilderFactory
     */
    private $searchCriteriaBuilderFactory;
    /**
     * @var BannersRepositoryInterface
     */
    private $bannersRepository;
    /**
     * @var FilterProvider
     */
    private $contentProcessor;
    /**
     * @var Json
     */
    private $jsonSerializer;

    /**
     * BannerSlider constructor.
     * @param BannerSliderRepositoryInterface $bannerSliderRepository
     * @param BannersRepositoryInterface $bannersRepository
     * @param SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
     * @param FilterProvider $contentProcessor
     * @param Json $jsonSerializer
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        BannerSliderRepositoryInterface $bannerSliderRepository,
        BannersRepositoryInterface $bannersRepository,
        SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
        FilterProvider $contentProcessor,
        Json $jsonSerializer,
        Optimizer $optimizer,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->bannerSliderRepository = $bannerSliderRepository;
        $this->bannersRepository = $bannersRepository;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->contentProcessor = $contentProcessor;
        $this->jsonSerializer = $jsonSerializer;
        $this->optimizer = $optimizer;
    }

    /**
     * @var Optimizer
     */
    private $optimizer;

    /**
     * Optimized (resized + optionally WebP) URL for a stored banner image path.
     *
     * @param string|null $path
     * @param int $width
     * @param string $format
     * @return string
     */
    public function getOptimizedUrl(?string $path, int $width, string $format = 'webp'): string
    {
        return $this->optimizer->getUrl($path, $width, $format);
    }

    /**
     * @return string
     */
    public function getImageClass()
    {
        $class ='';

        if ($this->getData('is_parallax')) {
            $class  .= 'img-parallax ';
        }

        return $class;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        $class =[];

        if ($this->getData('full_width')) {
            $class[]= 'full-width';
        }

        if ($this->getData('is_parallax')) {
            $class[]= 'is-parallax';
        }

        if ($this->getData('full_height')) {
            $class[]= 'full-height';
        }

        return implode(' ', $class);
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        $identities = [self::CACHE_TAG . '_' . $this->getData('slider_id')];
        $slider = $this->getSlider();
        $slideIds = $slider ? $this->getSliderSlides($slider) : [];
        foreach ((array) $slideIds as $slideId) {
            $identities[] = self::BANNER_CACHE_TAG . '_' . $slideId;
        }

        return $identities;
    }

    /**
     * Unique DOM id of the slider wrapper, so Slick binds to this instance only.
     *
     * @return string
     */
    public function getHtmlId(): string
    {
        if ($this->htmlId === null) {
            $this->htmlId = 'cw-slider-' . bin2hex(random_bytes(4));
        }

        return $this->htmlId;
    }

    /**
     * Unique DOM id of the tabs strip belonging to this slider.
     *
     * @return string
     */
    public function getTabsHtmlId(): string
    {
        return $this->getHtmlId() . '-tabs';
    }

    /**
     * The banners to show: only banners that still exist and are enabled, in slider order.
     *
     * @param BannerSliderInterface $slider
     * @return \CoullWorks\BannerSlider\Api\Data\BannersInterface[]
     */
    public function getActiveSlides($slider): array
    {
        $active = [];
        foreach ((array) $this->getSliderSlides($slider) as $slideId) {
            $slide = $this->getSlide($slideId);
            if ($slide && $slide->getEnabled()) {
                $active[] = $slide;
            }
        }

        return $active;
    }

    /**
     * @return bool|BannerSliderInterface
     */
    public function getSlider()
    {
        $sliderId= $this->getData('slider_id');
        try {
            $bannerSlider = $this->bannerSliderRepository->get($sliderId);
            return $bannerSlider;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param BannerSliderInterface $slider
     * @return array|bool
     */
    public function getSliderSlides($slider)
    {
        try {
            $slides =  $this->jsonSerializer->unserialize($slider->getSlides());
            return $slides;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getSlide($bannerId)
    {
        try {
            return $this->bannersRepository->get($bannerId);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function showTabs()
    {
        return $this->getData('show_tabs');
    }

    /**
     * @param $content
     * @return string
     * @throws \Exception
     */
    public function processContent($content)
    {
        return $this->contentProcessor->getPageFilter()->filter($content);
    }

    /**
     * @return false|string
     */
    public function getSliderConfig()
    {
        $config = [
            'slidesToShow' => 1,
            'slidesToScroll' => 1,
            'autoplay' => true,
            'autoplaySpeed' => 4500,
            'arrows' => $this->showTabs() ? false : true,
            'fade' => true,
        ];

        if ($this->showTabs()) {
            $config['asNavFor'] = '#' . $this->getTabsHtmlId();
        }

        return  $this->jsonSerializer->serialize($config);
    }

    /**
     * @return false|string
     */
    public function getTabsConfig()
    {
        $config = [
            'slidesToShow' => 4,
            'slidesToScroll' => 1,
            'autoplaySpeed' => 4500,
            'arrows' => false ,
            'dots' => false ,
            'fade' => false,
            'autoplay' => true,
            'centerMode' => true,
            'focusOnSelect' => true,
            'asNavFor' => '#' . $this->getHtmlId()
        ];

        return $this->jsonSerializer->serialize($config);
    }
}
