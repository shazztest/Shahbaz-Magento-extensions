<?php
namespace Pacifier\Core\Block;
class ReviewAll extends \Magento\Framework\View\Element\Template
{
	 /**
     * @var \Magento\Review\Model\ResourceModel\Review\CollectionFactory
     */
    protected $reviewCollectionFactory;

    /**
     * @var \Magento\Tax\Api\Data\TaxClassInterfaceFactory
     */
    protected $storeManager;

    /**
     * constructor.
     * @param \Magento\Review\Model\ResourceModel\Review\CollectionFactory $reviewCollectionFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */

	public function __construct(
		\Magento\Catalog\Block\Product\Context $context,
        \Magento\Review\Model\ResourceModel\Review\CollectionFactory $reviewCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
         array $data = []
    ) {
        $this->reviewCollectionFactory = $reviewCollectionFactory;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    public function getAllReviews()
    {
        $reviewsCollection = $this->reviewCollectionFactory->create()
            ->addStoreFilter($this->storeManager->getStore()->getStoreId())
            ->addStatusFilter(\Magento\Review\Model\Review::STATUS_APPROVED)
            ->setDateOrder()->setPageSize(10);
        return $reviewsCollection;
    }

}
