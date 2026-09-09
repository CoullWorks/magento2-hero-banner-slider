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
use Magento\Framework\Controller\Result\JsonFactory;

/**
 * Class InlineEdit
 * @package CoullWorks\BannerSlider\Controller\Adminhtml\Banners
 */
class InlineEdit extends \Magento\Backend\App\Action
{

    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var BannersFactory
     */
    private $bannersFactory;

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param BannersFactory $bannersFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        BannersFactory $bannersFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->bannersFactory = $bannersFactory;
    }

    /**
     * Inline edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute(): \Magento\Framework\Controller\ResultInterface
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $modelid) {
                    /** @var \CoullWorks\BannerSlider\Model\Banners $model */
                    $model = $this->bannersFactory->create()->load($modelid);
                    try {
                        $model->setData(array_merge($model->getData(), $postItems[$modelid]));
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Banners ID: {$modelid}]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
