<?php
declare(strict_types=1);

namespace Pacifier\Core\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    protected $_customersession;

    protected $storeManager;

    protected $_productloader;

    protected $_reviewFactory;

    protected $_customerRepositoryInterface;

    protected $httpContext;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\ProductFactory $_productloader,
        \Magento\Review\Model\ReviewFactory $reviewFactory,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Framework\App\Http\Context $httpContext

    ) {
        parent::__construct($context);
        $this->_customersession = $customerSession;
        $this->storeManager = $storeManager;
        $this->_productloader = $_productloader;
        $this->_reviewFactory = $reviewFactory;
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->httpContext = $httpContext;
    }

    public function getCheckSession()
    {
        return $this->_customersession;
    }

    public function getCustomerName(){
        return $this->_customersession->getCustomer()->getFirstname();
    }

    public function getStoreId()
    {
        return $this->storeManager->getStore()->getId();
    }

    public function getMediaUrl(){
        return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    public function getLoadProduct($id)
    {
        return $this->_productloader->create()->load($id);
    }

    public function getRatingSummary($product)
    {
        $this->_reviewFactory->create()->getEntitySummary($product, $this->getStoreId());
        $ratingSummary = $product->getRatingSummary()->getRatingSummary();
        return $ratingSummary;
    }

    public function getCustomerFirstName()
    {
        return $this->httpContext->getValue('customer_first_name');
    }
}