<?php

namespace Synamen\GoogleContent\Model\ResourceModel;

class Mapping extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('synamen_feed_category_mapping', 'id');
    }
}
