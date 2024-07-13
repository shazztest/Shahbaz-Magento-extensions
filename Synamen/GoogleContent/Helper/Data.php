<?php

namespace Synamen\GoogleContent\Helper;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\Store;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\ImportExport\Model\ResourceModel\Helper as ResourceHelper;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Backend\Model\Session;
use Magento\Catalog\Helper\Image;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Synamen\GoogleContent\Model\MappingFactory;
use Magento\Framework\Filesystem\DirectoryList;
use Google\Client;


class Data extends AbstractHelper
{
    /**
     * Cache tag
     *
     * @var string
     */
    const CACHE_TAG = 'feed_categories_config';

    /**
     * @var array
     */
    public $needyNameCategory = [
        5 => 'facebook',
        6 => 'yandex'
    ];

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var CacheInterface
     */
    public $cache;

    /**
     * @var SerializerInterface
     */
    public $serializer;

    /**
     * @var ResourceConnection
     */
    public $resource;

    /**
     * @var ResourceHelper
     */
    public $resourceHelper;

    /**
     * @var Image
     */
    public $Image;

    /**
     * @var Curl 
     */
    public $curl;


    public $categoryCollection;

    public $mappingFactory;

    public $filesystem;


    /**
     * Data constructor.
     *
     * @param StoreManagerInterface $storeManager
     * @param Context $context
     * @param CacheInterface $cache
     * @param SerializerInterface $serializer
     * @param ResourceConnection $resource
     * @param ResourceHelper $resourceHelper
     * @param Curl $curl
     * @param DirectoryList $filesystem
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        Context $context,
        CacheInterface $cache,
        SerializerInterface $serializer,
        ResourceConnection $resource,
        ResourceHelper $resourceHelper,
        Curl $curl,
        Session $backendSession,
        Image $Image,
        CollectionFactory $categoryCollection,
        MappingFactory $mappingFactory,
        DirectoryList $filesystem
    ) {
        $this->storeManager = $storeManager;
        $this->cache = $cache;
        $this->serializer = $serializer;
        $this->resource = $resource;
        $this->resourceHelper = $resourceHelper;
        $this->curl = $curl;
        $this->_backendSession = $backendSession;
        $this->Image = $Image;
        $this->categoryCollection = $categoryCollection;
        $this->mappingFactory = $mappingFactory;
        $this->_filesystem = $filesystem;

        parent::__construct($context);
    }

    /**
     * Get template options
     *
     * @return array
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getTemplateData()
    {
        /** @var Store $store */
        $store = $this->storeManager->getStore();
        return [
            'web_url' => $store->getBaseUrl(UrlInterface::URL_TYPE_WEB),
            'media_url' => $store->getBaseUrl(UrlInterface::URL_TYPE_MEDIA),
            'store_currency' => $store->getCurrentCurrency()->getCode(),
            'time' => date('H:i:s'),
            'date' => date('Y-m-d'),
        ];
    }

    /**
     * @param $categories
     * @param $identifier
     * @return bool
     */
    public function categoriesCacheSave($categories, $identifier)
    {
        $serializeCategories = $this->serializer->serialize($categories);
        return $this->cache->save($serializeCategories, $identifier, [self::CACHE_TAG]);
    }

    /**
     * @param $identifier
     * @return array|bool|float|int|string|null
     */
    public function getCategoriesCache($identifier)
    {
        $categories = [];
        $data = $this->cache->load($identifier);
        if (!empty($data)) {
            $categories = $this->serializer->unserialize($data);
        }

        return $categories;
    }

    /**
     * Get type_id
     *
     * @param $id
     * @return string
     */
    public function getTypeId($id)
    {
        $connection = $this->resource->getConnection();
        $table = $connection->getTableName('synamen_feed_category_mapping');
        $select = $connection->select()->from($table, 'type_id')->where('id = ?', $id);
        $result = $connection->fetchOne($select);

        return $result ? $result : '';
    }

    /**
     * Get mapping_data
     *
     * @param $id
     * @return array
     */
    public function getMappingData($id)
    {
        if (!$id) {
            return [];
        }

        $connection = $this->resource->getConnection();
        $table = $connection->getTableName('synamen_feed_category_mapping');
        $select = $connection->select()->from($table)->where('id = ?', $id);
        $data = $connection->fetchRow($select);
        if (empty($data)) {
            return [];
        }

        $typeId = $data['type_id'];
        $result = $this->serializer->unserialize($data['mapping_data']);

        if ($result) {
            if (isset($this->needyNameCategory[$typeId])) {
                $replaceIdOnNameCategory = [];
                foreach ($result as $key => $mappingData) {
                    $mappingData['source_category_feed'] = $this->getFeedCategoryName(
                        $id,
                        $typeId,
                        $mappingData['source_category_feed']
                    );

                    $replaceIdOnNameCategory[$key] = $mappingData;
                }

                $result = $replaceIdOnNameCategory;
            }
        } else {
            $result = [];
        }

        return $result;
    }

    /**
     * @param $id
     * @param $typeId
     * @param $feedCategoryId
     * @return mixed|string
     */
    public function getFeedCategoryName($id, $typeId, $feedCategoryId)
    {
        $categories = $this->getCategoriesCache("feed_categories_{$typeId}_{$id}");
        return $categories[$feedCategoryId] ?? 'no data category';
    }

    /**
     * @return int
     * @throws LocalizedException
     */
    public function getNextEntityId()
    {
        $table = 'synamen_feed_category_mapping';
        $id = $this->resourceHelper->getNextAutoincrement($table);

        return $id;
    }

    /**
     * @param $product 
     * 
     */
    public function makeProductRequest()
    {

        $mediapath = $this->_filesystem->getRoot();
        $credentialsFilePath = $mediapath.'/magewala-788268521699.json';

        $client = new Client();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/content');
        $client->fetchAccessTokenWithAssertion();
        $token = $client->getAccessToken();

        \Magento\Framework\App\ObjectManager::getInstance()->get(\Psr\Log\LoggerInterface::class)->debug("Token => ".var_dump($token));

        $store = $this->storeManager->getStore();
        //$productImageLink = $store->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' . $product->getData('image');
        
        /*$feed = [
            "id" => $product->getId(),
            "offerId" => "123456",
            "title" => $product->getName(),
            "description" => $product->getDescription(),
            "link" => $product->getProductUrl(),
            "imageLink" =>$productImageLink,  
            "contentLanguage" => "EN",
            "targetCountry" => "US", 
            "googleProductCategory" => "Media > Books",
            "channel" => "online",
            "availability" => "in stock",
            "gtin" => $product->getSku(),  
            "price" => [
                "value" => $product->getPrice(),
                "currency"=> $store->getCurrentCurrency()->getCode()
            ]
        ];*/

       // \Magento\Framework\App\ObjectManager::getInstance()->get(\Psr\Log\LoggerInterface::class)->debug();
        //return $feed;


    }
    public function getFeedCategory($product){

        $categoryIds = $product->getCategoryIds();
        $categories = $this->categoryCollection->create()->addAttributeToSelect('*')->addAttributeToFilter('entity_id', $categoryIds);
        $categoryNames = [];
        foreach ($categories as $category) {
            $categoryNames[] = $category->getName();
        }
        
        $connection = $this->resource->getConnection();
        $table = $connection->getTableName('synamen_feed_category_mapping');
        $select = $connection->select('mapping_data')->from($table);
        $data = $connection->fetchRow($select);
        if (empty($data)) {
            return [];
        }

        
        $result = $this->serializer->unserialize($data['mapping_data']);
        $googleCategory = "";
        foreach ($result as $key => $value) {

            $storeCategory = $value['source_category_magento'];
            foreach ($categoryNames as $categoryName) {
                if(strpos($storeCategory, $categoryName) !== FALSE) {
                    $googleCategory = $value['source_category_feed'];
                }
            }    
        }
        
        return $googleCategory;
    }

}
