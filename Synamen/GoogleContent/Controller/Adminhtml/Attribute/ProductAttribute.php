<?php

declare(strict_types=1);

namespace Synamen\GoogleContent\Controller\Adminhtml\Attribute;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

class ProductAttribute extends Action
{
    /**
     * @inheritdoc
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create($this->resultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Attribute Mapping'));

        return $resultPage;
    }
}