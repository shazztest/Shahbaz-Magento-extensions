<?php

namespace Synamen\GoogleContent\Model\ResourceModel\Mapping;

use Synamen\GoogleContent\Model\Mapping as MappingModel;
use Synamen\GoogleContent\Model\ResourceModel\Mapping as MappingResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    public function _construct()
    {
        $this->_init(MappingModel::class, MappingResourceModel::class);
    }
}
