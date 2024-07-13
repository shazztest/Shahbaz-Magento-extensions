<?php
declare(strict_types=1);

namespace Synamen\Contact\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class SynamenContacts extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('synamen_contact_synamen_contacts', 'synamen_contacts_id');
    }
}

