<?php
namespace Pacifier\Core\Block;
class RelatedProduct extends \Magento\Catalog\Block\Product\AbstractProduct
{
	public function __construct(
        \Magento\Catalog\Block\Product\Context $context,     
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Review\Model\ReviewFactory $reviewFactory, 
         array $data = []
    ) {
        $this->categoryFactory = $categoryFactory;
        $this->registry = $registry;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_storeManager = $storeManager;
        $this->_reviewFactory = $reviewFactory;
        parent::__construct($context, $data);
    }
    

    public function getCurrentProductId(){
        return $this->registry->registry('current_product');
    }

    public function getProductCollection($id){
        $collection = $this->_productCollectionFactory->create()
        ->addAttributeToSelect('*')
        ->addStoreFilter()
        ->addFieldToFilter(
            'entity_id',
            ['in' => $id]
        )
        ->addCategoryIds();
        return $collection;
    }

    public function getProductCollectionByCategories($ids)
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addCategoriesFilter(['in' => $ids]);
        $collection->addAttributeToFilter('status', array('eq' => 1));
        $collection->getSelect()->orderRand();
        $collection->setPageSize(20);
        return $collection;
    }

    public function getMediaUrl(){
        $mediaUrl = $this ->_storeManager-> getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl;
    }

    public function getRatingSummary($product){
        $storeId = $this->_storeManager->getStore()->getId();
        $this->_reviewFactory->create()->getEntitySummary($product,$storeId);
        $ratingSummary = $product->getRatingSummary()->getRatingSummary();
        return $ratingSummary;
    }

}