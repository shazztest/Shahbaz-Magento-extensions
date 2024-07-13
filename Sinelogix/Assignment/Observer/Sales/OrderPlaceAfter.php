<?php
declare(strict_types=1);

namespace Sinelogix\Assignment\Observer\Sales;

use Psr\Log\LoggerInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class OrderPlaceAfter implements \Magento\Framework\Event\ObserverInterface
{

    protected $logger;
 
    public function __construct(
        LoggerInterface $logger,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        StateInterface $state,
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->logger = $logger;
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $state;
        $this->scopeConfig = $scopeConfig;
    }

    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {

        try {
            $_order = $observer->getEvent()->getOrder();
            $isOffline = $_order->getPayment()->getMethodInstance()->isOffline();

            // if payment method is not offline
            if(!$isOffline){
                $this->sendEmail($_order);
            }

        } catch (\Exception $e) {
            $this->logger->info($e->getMessage());
        }
    }

    public function sendEmail($order)
    {   
        $customerEmail = $order->getCustomerEmail();
        $adminEmail = $this->scopeConfig->getValue('trans_email/ident_sales/email',ScopeInterface::SCOPE_STORE);
        $paymentMethod = $order->getPayment()->getMethodInstance()->getTitle();

        $templateId = 'sinelogix_template'; // custom template id
        $fromEmail = $adminEmail;
        $fromName = 'Sinelogix Test Pay'; // sender Name
        $toEmail = $customerEmail;
 
        try {
            // template variables 
            $templateVars = [
                'customer_name' => $order->getCustomerName(),
                'order_id' => $order->getIncrementId(),
                'payment_method' => $paymentMethod
            ];
 
            $storeId = $this->storeManager->getStore()->getId();
 
            $from = ['email' => $fromEmail, 'name' => $fromName];
            $this->inlineTranslation->suspend();
 
            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $templateOptions = [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $storeId
            ];
            $transport = $this->transportBuilder->setTemplateIdentifier($templateId, $storeScope)
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars($templateVars)
                ->setFrom($from)
                ->addTo($toEmail)
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->_logger->info($e->getMessage());
        }
    }


}

