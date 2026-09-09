<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Controller\Adminhtml\BannerSlider;

use CoullWorks\BannerSlider\Model\BannerSliderFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Edit
 * @package CoullWorks\BannerSlider\Controller\Adminhtml\BannerSlider
 */
class Edit extends \CoullWorks\BannerSlider\Controller\Adminhtml\BannerSlider
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var BannerSliderFactory
     */
    private $bannerSliderFactory;

    /**
     * @param Context $context
     * @param DataPersistorInterface $coreRegistry
     * @param PageFactory $resultPageFactory
     * @param BannerSliderFactory $bannerSliderFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $coreRegistry,
        PageFactory $resultPageFactory,
        BannerSliderFactory $bannerSliderFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->bannerSliderFactory = $bannerSliderFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute(): \Magento\Framework\Controller\ResultInterface
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('bannerslider_id');
        $model = $this->bannerSliderFactory->create();

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
