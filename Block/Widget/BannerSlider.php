<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 */

namespace BoxLeafDigital\BannerSlider\Block\Widget;

use BoxLeafDigital\BannerSlider\Api\BannerSliderRepositoryInterface;
use BoxLeafDigital\BannerSlider\Api\BannersRepositoryInterface;
use BoxLeafDigital\BannerSlider\Api\Data\BannerSliderInterface;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Element\Template;

/**
 * Class BannerSlider
 * @package BoxLeafDigital\BannerSlider\Block\Widget
 */
class BannerSlider extends Template implements IdentityInterface
{
    const CACHE_TAG = 'banner_s';

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
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->bannerSliderRepository = $bannerSliderRepository;
        $this->bannersRepository = $bannersRepository;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->contentProcessor = $contentProcessor;
        $this->jsonSerializer = $jsonSerializer;
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
        return [self::CACHE_TAG . '_' . $this->getData('slider_id')];
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
            $config['asNavFor'] = '.tabs';
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
            'asNavFor' => '.slider'
        ];

        return $this->jsonSerializer->serialize($config);
    }
}
