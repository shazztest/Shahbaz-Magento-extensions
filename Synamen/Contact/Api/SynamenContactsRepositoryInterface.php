<?php
declare(strict_types=1);

namespace Synamen\Contact\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SynamenContactsRepositoryInterface
{

    /**
     * Save synamen_contacts
     * @param \Synamen\Contact\Api\Data\SynamenContactsInterface $synamenContacts
     * @return \Synamen\Contact\Api\Data\SynamenContactsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Synamen\Contact\Api\Data\SynamenContactsInterface $synamenContacts
    );

    /**
     * Retrieve synamen_contacts
     * @param string $synamenContactsId
     * @return \Synamen\Contact\Api\Data\SynamenContactsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($synamenContactsId);

    /**
     * Retrieve synamen_contacts matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Synamen\Contact\Api\Data\SynamenContactsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete synamen_contacts
     * @param \Synamen\Contact\Api\Data\SynamenContactsInterface $synamenContacts
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Synamen\Contact\Api\Data\SynamenContactsInterface $synamenContacts
    );

    /**
     * Delete synamen_contacts by ID
     * @param string $synamenContactsId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($synamenContactsId);
}

