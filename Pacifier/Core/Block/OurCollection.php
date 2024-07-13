<?php
namespace Pacifier\Core\Block;

class OurCollection extends \Magento\Catalog\Block\Product\AbstractProduct
{
     protected $categoryFactory;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,     
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
         array $data = []
    ) {
        $this->categoryFactory = $categoryFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context, $data);
    }
    public function getOurCollectionData($id)
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');      
        $collection->addCategoriesFilter(['in' =>$id]);
        $collection->addAttributeToSort('entity_id','desc')->load(); 
        return $collection;
    }
}