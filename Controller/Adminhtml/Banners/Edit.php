<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Controller\Adminhtml\Banners;

use CoullWorks\BannerSlider\Model\BannersFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Edit
 * @package CoullWorks\BannerSlider\Controller\Adminhtml\Banners
 */
class Edit extends \CoullWorks\BannerSlider\Controller\Adminhtml\Banners
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var BannersFactory
     */
    private $bannersFactory;

    /**
     * @param Context $context
     * @param DataPersistorInterface $coreRegistry
     * @param PageFactory $resultPageFactory
     * @param BannersFactory $bannersFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $coreRegistry,
        PageFactory $resultPageFactory,
        BannersFactory $bannersFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->bannersFactory = $bannersFactory;
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
        $id = $this->getRequest()->getParam('banners_id');
        $model = $this->bannersFactory->create();

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Banners no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Banners') : __('New Banners'),
            $id ? __('Edit Banners') : __('New Banners')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Bannerss'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Banners %1', $model->getId()) : __('New Banners'));
        return $resultPage;
    }
}
