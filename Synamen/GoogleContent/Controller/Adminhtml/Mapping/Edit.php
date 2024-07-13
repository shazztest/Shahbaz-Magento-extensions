<?php

namespace Synamen\GoogleContent\Controller\Adminhtml\Mapping;

class Edit extends Mapping
{
    /**
     * @inheritdoc
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Synamen_GoogleContent::mapping_index');

        return $resultPage;
    }
}
