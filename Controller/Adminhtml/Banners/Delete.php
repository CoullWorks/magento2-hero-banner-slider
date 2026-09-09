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

/**
 * Class Delete
 * @package CoullWorks\BannerSlider\Controller\Adminhtml\Banners
 */
class Delete extends \CoullWorks\BannerSlider\Controller\Adminhtml\Banners
{

    /**
     * @var BannersFactory
     */
    private $bannersFactory;

    /**
     * @param Context $context
     * @param DataPersistorInterface $coreRegistry
     * @param BannersFactory $bannersFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $coreRegistry,
        BannersFactory $bannersFactory
    ) {
        $this->bannersFactory = $bannersFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute(): \Magento\Framework\Controller\ResultInterface
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('banners_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->bannersFactory->create();
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Banners.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['banners_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Banners to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
