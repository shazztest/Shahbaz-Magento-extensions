<?php
declare(strict_types=1);

namespace Synamen\Contact\Model\ResourceModel\SynamenContacts;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'synamen_contacts_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Synamen\Contact\Model\SynamenContacts::class,
            \Synamen\Contact\Model\ResourceModel\SynamenContacts::class
        );
    }
}

