<?php
namespace Synamen\Orderapi\Model\Api;

use Synamen\Orderapi\Api\SynamenOrderRepositoryInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\Data\OrderItemInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;



class OrderRepository implements SynamenOrderRepositoryInterface
{

	protected $_orderRepositoryInterface;
    protected $_searchCriteriaBuilder;

    /**
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * 
     */
    public function __construct(
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepositoryInterface,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    ) 
    {
        $this->_orderRepositoryInterface = $orderRepositoryInterface;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        
    }

    public function getOrder(int $orderId)
    {
        $data = [];
        $orderData = ['response'=>null];
        $this->_searchCriteriaBuilder->addFilter('increment_id', $orderId);
        $orders = $this->_orderRepositoryInterface->getList(
            $this->_searchCriteriaBuilder->create()
        )->getItems();
        if (count($orders)) {
            $order = reset($orders);
            $data = $order->getData();
            foreach($order->getItems() as $item) {
                $data['items'][$item->getItemId()] = $item->getData();
            }
        }
        $orderData['response'] = $data;
        return $orderData;
    }

}