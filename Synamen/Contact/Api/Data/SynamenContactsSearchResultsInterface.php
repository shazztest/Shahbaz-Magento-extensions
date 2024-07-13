<?php
declare(strict_types=1);

namespace Synamen\Contact\Api\Data;

interface SynamenContactsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get synamen_contacts list.
     * @return \Synamen\Contact\Api\Data\SynamenContactsInterface[]
     */
    public function getItems();

    /**
     * Set Name list.
     * @param \Synamen\Contact\Api\Data\SynamenContactsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

