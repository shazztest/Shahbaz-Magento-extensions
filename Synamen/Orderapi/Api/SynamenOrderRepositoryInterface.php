<?php
namespace Synamen\Orderapi\Api;

interface SynamenOrderRepositoryInterface
{
    /**
     * Return a filtered order.
     *
     * @param int $id
     * @return \Synamen\Orderapi\Api\SynamenOrderRepositoryInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getOrder(int $id);
}