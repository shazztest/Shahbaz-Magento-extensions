<?php

namespace Synamen\GoogleContent\Controller\Adminhtml\Mapping;

class Add extends Mapping
{
    /**
     * @inheritdoc
     */
    public function execute()
    {
        return $this->resultFactory->create($this->resultFactory::TYPE_FORWARD)
            ->forward('edit');
    }
}
