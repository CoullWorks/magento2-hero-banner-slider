<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Controller\Adminhtml\BannerSlider;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Edit
 * @package BoxLeafDigital\BannerSlider\Controller\Adminhtml\BannerSlider
 */
class Edit extends \BoxLeafDigital\BannerSlider\Controller\Adminhtml\BannerSlider
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param DataPersistorInterface $coreRegistry
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $coreRegistry,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('bannerslider_id');
        $model = $this->_objectManager->create(\BoxLeafDigital\BannerSlider\Model\BannerSlider::class);

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Bannerslider no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Bannerslider') : __('New Bannerslider'),
            $id ? __('Edit Bannerslider') : __('New Bannerslider')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Bannersliders'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Bannerslider %1', $model->getId()) : __('New Bannerslider'));
        return $resultPage;
    }
}
