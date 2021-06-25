<?php
/**
 *   @author     Daniel Coull <hello@boxleafdigital.com>
 *   @copyright  27/01/2020, 19:29 Daniel Coull
 *   @version   1.0.0
 *
 */

namespace BoxLeafDigital\BannerSlider\Model\Banners;

use BoxLeafDigital\BannerSlider\Model\ResourceModel\Banners\CollectionFactory;
use Magento\Catalog\Model\Category\Attribute\Backend\Image as ImageBackendModel;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\File\Mime;
use Magento\Framework\Filesystem;

/**
 * Class DataProvider
 * @package BoxLeafDigital\BannerSlider\Model\Banners
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    /**
     * @var \BoxLeafDigital\BannerSlider\Model\ResourceModel\Banners\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;


    protected $loadedData;

    /* @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;
    /**
     * @var Filesystem
     */
    private $_filesystem;
    /**
     * @var Mime
     */
    private $_mime;

    /**
     * @var Filesystem\Directory\WriteInterface
     */
    private $_mediaDirectory;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param Filesystem $filesystem
     * @param Mime $mime
     * @param array $meta
     * @param array $data
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        Filesystem $filesystem,
        Mime $mime,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->_storeManager = $storeManager;
        $this->_filesystem = $filesystem;
        $this->_mime = $mime;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->_mediaDirectory = $this->_filesystem->getDirectoryWrite(DirectoryList::MEDIA);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
            $this->loadedData[$model->getId()] = $this->convertValues($model, $this->loadedData[$model->getId()]);

        }
        $data = $this->dataPersistor->get('boxleafdigital_bannerslider_banners');

        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->loadedData[$model->getId()] = $this->convertValues($model, $this->loadedData[$model->getId()]);

            $this->dataPersistor->clear('boxleafdigital_bannerslider_banners');
        }


        return $this->loadedData;
    }

    /**
     * @param $model
     * @param $data
     * @return mixed
     */
    private function convertValues($model, $data)
    {
        $imageAttributes = [
            'banner_image_mobile',
            'banner_image'
        ];

        foreach ($imageAttributes as $attribute) {

            if (!isset($data[$attribute])) {
                continue;
            }

            unset($data[$attribute]);

            $fileName = $model->getData($attribute);
            $path = $this->_mediaDirectory->getAbsolutePath($fileName);


            if ($this->_mediaDirectory->isExist($fileName)) {

                $stat = $this->_mediaDirectory->stat($fileName);
                $mime = $this->_mime->getMimeType($path);

                // phpcs:ignore Magento2.Functions.DiscouragedFunction
                $data[$attribute][0]['name'] = basename($fileName);

                $data[$attribute][0]['url'] = $model->getDataModel()->getImageUrl($attribute);

                $data[$attribute][0]['size'] = isset($stat) ? $stat['size'] : 0;
                $data[$attribute][0]['type'] = $mime;
            }
        }

        return $data;
    }

    /**
     * @param $name
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getImageUrl($name)
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return 'media/banner/image/'.$name;
    }
}
