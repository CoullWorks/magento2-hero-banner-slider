<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Block\Adminhtml\Banners\Edit;

use CoullWorks\BannerSlider\Api\BannersRepositoryInterface;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Escaper;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 * @package CoullWorks\BannerSlider\Block\Adminhtml\Banners\Edit
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @var BannersRepositoryInterface
     */
    private $repository;

    /**
     * @var Escaper
     */
    private $escaper;

    public function __construct(Context $context, BannersRepositoryInterface $repository, Escaper $escaper)
    {
        parent::__construct($context);
        $this->repository = $repository;
        $this->escaper = $escaper;
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getModelId()) {
            $data = [
                'label' => __('Delete Banners'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . $this->getConfirmMessage() . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * Confirmation text naming the record, as the grid dialog does, safe inside a JS string.
     *
     * @return string
     */
    private function getConfirmMessage(): string
    {
        try {
            $name = (string) $this->repository->get($this->getModelId())->getBannerName();
        } catch (NoSuchEntityException $e) {
            $name = '';
        }
        if ($name === '') {
            $name = '#' . $this->getModelId();
        }
        return $this->escaper->escapeJs(
            (string) __('Delete "%1"?', $this->escaper->escapeHtml($name))
        );
    }

    /**
     * Get URL for delete button
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['banners_id' => $this->getModelId()]);
    }
}
