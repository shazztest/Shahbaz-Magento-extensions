<?php
namespace Synamen\GoogleContent\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
//use Synamen\GoogleContent\lib\Google\Client;
use Google\Client;

class Index implements HttpGetActionInterface
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        PageFactory $resultPageFactory,
        \Synamen\GoogleContent\Helper\Data $helper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Filesystem\DirectoryList $filesystem,
        \Magento\Catalog\Model\ProductRepository $productRepository
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->helper = $helper;
        $this->scopeConfig = $scopeConfig;
        $this->_filesystem = $filesystem;
        $this->_productRepository = $productRepository;
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $id = 1;
        $product = $this->_productRepository->getById($id);
        $this->helper->getFeedCategory($product);
        
    }




}