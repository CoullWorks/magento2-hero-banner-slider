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
use Magento\Catalog\Model\ImageUploader;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Save
 * @package CoullWorks\BannerSlider\Controller\Adminhtml\Banners
 */
class Save extends \Magento\Backend\App\Action
{

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param StoreManagerInterface $storeManager
     * @param BannersFactory $bannersFactory
     * @param ImageUploader $imageUpload
     */
    public function __construct(
        Context $context,
        private readonly DataPersistorInterface $dataPersistor,
        private readonly StoreManagerInterface $storeManager,
        private readonly BannersFactory $bannersFactory,
        private readonly ImageUploader $imageUpload
    ) {
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute(): \Magento\Framework\Controller\ResultInterface
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $id = $this->getRequest()->getParam('banners_id');

            $model = $this->bannersFactory->create()->load($id);
            if (!$model->getBannersId() && $id) {
                $this->messageManager->addErrorMessage(__('This Banners no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

            $data['banner_image'] = $this->resolveImagePath(
                $data['banner_image'] ?? null,
                (string)$model->getBannerImage(),
                $mediaUrl
            );

            $data['banner_image_mobile'] = $this->resolveImagePath(
                $data['banner_image_mobile'] ?? null,
                (string)$model->getBannerImageMobile(),
                $mediaUrl
            );

            $model->setData($data);
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Banners.'));
                $this->dataPersistor->clear('coullworks_banner_slider_banners');

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

    /**
     * Resolve the UI-component image uploader payload to a stored relative media path.
     *
     * Handles all three cases consistently for both desktop and mobile images:
     *  (a) a newly uploaded temp file  -> move it out of tmp and store banner/image/<name>
     *  (b) an existing image kept      -> strip the media URL prefix to a clean relative path
     *  (c) no image                    -> fall back to the currently persisted value
     *
     * The relative path is always returned with no leading slash so that
     * \CoullWorks\BannerSlider\Model\Data\Banners::getImageUrl() prepends the media base URL.
     *
     * @param array|string|null $field The raw uploader field value from the POST payload.
     * @param string $existingImage The value currently stored on the model.
     * @param string $mediaUrl The store media base URL.
     * @return string
     */
    private function resolveImagePath(array|string|null $field, string $existingImage, string $mediaUrl): string
    {
        // (a) newly uploaded temp file. Passing $returnRelativePath = true returns the
        // full "banner/image/<name>" path, which also lets Magento's media-gallery
        // synchronization plugin (on the shared Catalog ImageUploader) find the moved
        // file at the correct location instead of the media root (2.4.6+).
        if (isset($field[0]['name'], $field[0]['tmp_name'])) {
            return ltrim($this->imageUpload->moveFileFromTmp($field[0]['name'], true), '/');
        }

        // (b) existing image kept unchanged
        if (isset($field[0]['name']) && !isset($field[0]['tmp_name'])) {
            $url = $field[0]['url'] ?? '';
            return ltrim(str_replace([$mediaUrl, '/media/'], '', $url), '/');
        }

        // (c) no image in the payload
        return ltrim($existingImage, '/');
    }
}
