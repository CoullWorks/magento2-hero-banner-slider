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
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 * @package CoullWorks\BannerSlider\Controller\Adminhtml\BannerSlider
 */
class Save extends \Magento\Backend\App\Action
{

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param BannerSliderFactory $bannerSliderFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        private readonly DataPersistorInterface $dataPersistor,
        private readonly BannerSliderFactory $bannerSliderFactory
    ) {
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute(): \Magento\Framework\Controller\ResultInterface
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $id = $this->getRequest()->getParam('bannerslider_id');
            $data['slides'] = json_encode($data['slides'] ?? []);
            $model = $this->bannerSliderFactory->create()->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Bannerslider no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Bannerslider.'));

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['bannerslider_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Bannerslider.'));
            }

            return $resultRedirect->setPath('*/*/edit', ['bannerslider_id' => $this->getRequest()->getParam('bannerslider_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
