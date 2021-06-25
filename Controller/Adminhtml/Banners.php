<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Controller\Adminhtml;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class Banners
 * @package BoxLeafDigital\BannerSlider\Controller\Adminhtml
 */
abstract class Banners extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'BoxLeaf_BannerSlider::top_level';
    /**
     * @var DataPersistorInterface
     */
    protected $_coreRegistry;

    /**
     * @param Context $context
     * @param DataPersistorInterface $coreRegistry
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('BoxLeaf'), __('BoxLeaf'))
            ->addBreadcrumb(__('Banners'), __('Banners'));
        return $resultPage;
    }
}
