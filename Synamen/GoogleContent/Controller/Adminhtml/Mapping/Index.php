<?php

namespace Synamen\GoogleContent\Controller\Adminhtml\Mapping;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

class Index extends Action
{
    /**
     * @inheritdoc
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create($this->resultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Synamen_GoogleContent::mapping_index')
            ->addBreadcrumb(__('Feed Category Mapping'), __('Feed Category Mapping'));
        $resultPage->getConfig()->getTitle()->prepend(__('Feed Category Mapping'));

        return $resultPage;
    }
}
