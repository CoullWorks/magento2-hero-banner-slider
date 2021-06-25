<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Block\Widget;

use BoxLeafDigital\BannerSlider\Api\BannerSliderRepositoryInterface;
use BoxLeafDigital\BannerSlider\Api\BannersRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

/**
 * Class HeroBanner
 * @package BoxLeafDigital\BannerSlider\Block\Widget
 */
class HeroBanner extends Template implements IdentityInterface
{


    const CACHE_TAG = 'banner_h';

    protected $_cacheTag = self::CACHE_TAG;

    protected $_template = "banner/hero.phtml";
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
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    private $contentProcessor;

    /**
     * HeroBanner constructor.
     * @param BannerSliderRepositoryInterface $bannerSliderRepository
     * @param BannersRepositoryInterface $bannersRepository
     * @param SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
     * @param \Magento\Cms\Model\Template\FilterProvider $contentProcessor
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        BannerSliderRepositoryInterface $bannerSliderRepository,
        BannersRepositoryInterface $bannersRepository,
        SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
        \Magento\Cms\Model\Template\FilterProvider $contentProcessor,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->bannerSliderRepository = $bannerSliderRepository;
        $this->bannersRepository = $bannersRepository;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->contentProcessor = $contentProcessor;
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
     * @return bool|\BoxLeafDigital\BannerSlider\Api\Data\BannersInterface
     */
    public function getSlide()
    {
        try {
            return $this->bannersRepository->get($this->getData('banner_id'));
        } catch (\Exception $e) {
            return false;
        }
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
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [$this->_cacheTag . '_' . $this->getData('banner_id')];
    }
}
