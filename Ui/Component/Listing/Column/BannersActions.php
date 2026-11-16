<?php
/**
 *   @author     danrcoull <ttechitsolutions@gmail.com>
 *   @copyright  27/01/2020, 19:29 danrcoull
 *   @version   1.0.0
 *
 */

declare(strict_types=1);

namespace CoullWorks\BannerSlider\Ui\Component\Listing\Column;

class BannersActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    const URL_PATH_EDIT = 'coullworks_banner_slider/banners/edit';
    const URL_PATH_DELETE = 'coullworks_banner_slider/banners/delete';
    protected $urlBuilder;

    /**
     * @var \Magento\Framework\Escaper
     */
    private $escaper;
    const URL_PATH_DETAILS = 'coullworks_banner_slider/banners/details';

    /**
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\Framework\Escaper $escaper
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\Escaper $escaper,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->escaper = $escaper;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['banners_id'])) {
                    $label = '"' . str_replace('$', '&#36;', $this->escaper->escapeHtml((string) ($item['banner_name'] ?? '#' . $item['banners_id']))) . '"';
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                    'banners_id' => $item['banners_id']
                                ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'banners_id' => $item['banners_id']
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete %1', $label),
                                'message' => __('Are you sure you want to delete %1?', $label)
                            ]
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
