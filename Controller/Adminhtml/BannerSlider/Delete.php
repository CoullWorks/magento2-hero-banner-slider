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

/**
 * Class Delete
 * @package CoullWorks\BannerSlider\Controller\Adminhtml\BannerSlider
 */
class Delete extends \CoullWorks\BannerSlider\Controller\Adminhtml\BannerSlider
{

    /**
     * @var BannerSliderFactory
     */
    private $bannerSliderFactory;

    /**
     * @param Context $context
     * @param DataPersistorInterface $coreRegistry
     * @param BannerSliderFactory $bannerSliderFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $coreRegistry,
        BannerSliderFactory $bannerSliderFactory
    ) {
        $this->bannerSliderFactory = $bannerSliderFactory;
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
        $id = $this->getRequest()->getParam('bannerslider_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->bannerSliderFactory->create();
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Bannerslider.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['bannerslider_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Bannerslider to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
