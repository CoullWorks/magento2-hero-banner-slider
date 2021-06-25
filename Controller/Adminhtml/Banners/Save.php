<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Controller\Adminhtml\Banners;

use BoxLeafDigital\BannerSlider\Model\Banners;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Save
 * @package BoxLeafDigital\BannerSlider\Controller\Adminhtml\Banners
 */
class Save extends \Magento\Backend\App\Action
{

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \BoxLeafDigital\BannerSlider\Model\ImageUpload
     */
    private $imageUpload;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManager
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $id = $this->getRequest()->getParam('banners_id');

            $model = $this->_objectManager->create(Banners::class)->load($id);
            if (!$model->getBannersId() && $id) {
                $this->messageManager->addErrorMessage(__('This Banners no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $this->imageUpload = \Magento\Framework\App\ObjectManager::getInstance()->get(\BoxLeafDigital\BannerSlider\Model\ImageUpload::class);
            $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

            if (isset($data['banner_image'][0]['name']) && isset($data['banner_image'][0]['tmp_name'])) {
                $data['banner_image'] = 'banner/image/' . $this->imageUpload->moveFileFromTmp($data['banner_image'][0]['name']);
            } elseif (isset($data['banner_image'][0]['name']) && !isset($data['banner_image'][0]['tmp_name'])) {
                $data['banner_image'] = ltrim(str_replace([$mediaUrl,'/media/'], '', $data['banner_image'][0]['url']), '/');
            } else {
                $data['banner_image'] = ltrim($model->getBannerImage(), '/');
            }

            if (isset($data['banner_image_mobile'][0]['name']) && isset($data['banner_image_mobile'][0]['tmp_name'])) {
                $data['banner_image_mobile'] = 'banner/image/' . $this->imageUpload->moveFileFromTmp($data['banner_image_mobile'][0]['name']);
            } elseif (isset($data['banner_image_mobile'][0]['name']) && !isset($data['banner_image_mobile'][0]['tmp_name'])) {
                $data['banner_image_mobile'] = ltrim(str_replace([$mediaUrl,'/media/'], '', $data['banner_image_mobile'][0]['url']));
            } else {
                $data['banner_image_mobile'] =  ltrim($model->getBannerImageMobile(), '/');
            }

            $model->setData($data);
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Banners.'));
                $this->dataPersistor->clear('boxleaf_bannerslider_banners');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['banners_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Banners.'));
            }

            return $resultRedirect->setPath('*/*/edit', ['banners_id' => $this->getRequest()->getParam('banners_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
