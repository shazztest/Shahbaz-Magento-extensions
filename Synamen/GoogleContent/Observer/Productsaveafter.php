<?php
namespace Synamen\GoogleContent\Observer;

use Magento\Framework\Event\ObserverInterface;
use Google\Client;
use Google\Service\ShoppingContent;
use Google\Service\ShoppingContent\Product;
use Google\Service\ShoppingContent\Price;
use Google\Service\ShoppingContent\ProductShipping;
use Google\Service\ShoppingContent\ProductShippingWeight;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Filesystem;
use Magento\CatalogInventory\Model\Stock\StockItemRepository;
use Magento\Framework\Url;
use Synamen\GoogleContent\Helper\Data;


class Productsaveafter implements ObserverInterface
{   
    protected $_storeManager;

    protected $_scopeConfig;

    protected $_fileSystem;

    protected $_stockItem;

    public function __construct(
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig,
        Filesystem $fileSystem,
        StockItemRepository $stockItem,
        Url $url,
        Data $synamenHelperData

    ){
        $this->_storeManager = $storeManager;
        $this->_scopeConfig = $scopeConfig;
        $this->_fileSystem = $fileSystem;
        $this->_stockItem = $stockItem;
        $this->url = $url;
        $this->_synamenHelperData = $synamenHelperData;


    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {


        $_product = $observer->getProduct();
        $this->sendProductToApi($_product);
                    
    }

    

    /**
     * Calls Api
     *
     * @param \Magento\Catalog\Model\Product $_product
     * 
     */

    public function sendProductToApi($_product){
 
       
        $currencyCode = $this->_storeManager->getStore()->getCurrentCurrency();
        $productImageLink = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' . $_product->getData('image');


        $googleApifile = $this->_scopeConfig->getValue('synamen_googleapi/syanmen/googleapi_key_file');
        $mediaPath = $this->_fileSystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)->getAbsolutePath();


        $apiKeyfile = $mediaPath.'/googleapi/'.$googleApifile;
        $merchantId = $this->_scopeConfig->getValue('synamen_googleapi/syanmen/merchant_id');
        $targetCountry = $this->_scopeConfig->getValue('synamen_googleapi/syanmen/targetcountry');

        $productUrl = $this->url->getUrl('catalog/product/view', ['id' => $_product->getId(), '_nosid' => true]);

        $stock = $this->_stockItem->get($_product->getId());        
        $status = "";
        if($stock->getIsInStock() == 1){
            $status = "In Stock";
        }else{
            $status = "Out of Stock";
        }

        $googleProductCategory = $this->_synamenHelperData->getFeedCategory($_product);
        

        $client = new Client();
        $client->setAuthConfig($apiKeyfile);
        $client->addScope( 'https://www.googleapis.com/auth/content' );
        $client->fetchAccessTokenWithAssertion();        
        
        $service = new ShoppingContent($client);
        $product = new Product();
        
        $product->setOfferId($_product->getId());
        $product->setTitle($_product->getName());
        $product->setDescription($_product->getShortDescription());
        $product->setLink($productUrl);
        $product->setImageLink($productImageLink);
        $product->setContentLanguage('en');
        $product->setTargetCountry($targetCountry);
        $product->setChannel('online');
        $product->setAvailability($status);
        $product->setCondition('new');
        $product->setGoogleProductCategory($googleProductCategory);
        $product->setGtin('9780003435896');

        $price = new Price();
        $price->setValue($_product->getPrice());
        $price->setCurrency($currencyCode->getCurrencyCode());

        $product->setPrice($price);

        $result = $service->products->insert($merchantId , $product);
    }

}