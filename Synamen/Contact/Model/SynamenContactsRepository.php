<?php
declare(strict_types=1);

namespace Synamen\Contact\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Synamen\Contact\Api\Data\SynamenContactsInterface;
use Synamen\Contact\Api\Data\SynamenContactsInterfaceFactory;
use Synamen\Contact\Api\Data\SynamenContactsSearchResultsInterfaceFactory;
use Synamen\Contact\Api\SynamenContactsRepositoryInterface;
use Synamen\Contact\Model\ResourceModel\SynamenContacts as ResourceSynamenContacts;
use Synamen\Contact\Model\ResourceModel\SynamenContacts\CollectionFactory as SynamenContactsCollectionFactory;

class SynamenContactsRepository implements SynamenContactsRepositoryInterface
{

    /**
     * @var SynamenContacts
     */
    protected $searchResultsFactory;

    /**
     * @var ResourceSynamenContacts
     */
    protected $resource;

    /**
     * @var SynamenContactsInterfaceFactory
     */
    protected $synamenContactsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var SynamenContactsCollectionFactory
     */
    protected $synamenContactsCollectionFactory;


    /**
     * @param ResourceSynamenContacts $resource
     * @param SynamenContactsInterfaceFactory $synamenContactsFactory
     * @param SynamenContactsCollectionFactory $synamenContactsCollectionFactory
     * @param SynamenContactsSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceSynamenContacts $resource,
        SynamenContactsInterfaceFactory $synamenContactsFactory,
        SynamenContactsCollectionFactory $synamenContactsCollectionFactory,
        SynamenContactsSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->synamenContactsFactory = $synamenContactsFactory;
        $this->synamenContactsCollectionFactory = $synamenContactsCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(
        SynamenContactsInterface $synamenContacts
    ) {
        try {
            $this->resource->save($synamenContacts);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the synamenContacts: %1',
                $exception->getMessage()
            ));
        }
        return $synamenContacts;
    }

    /**
     * @inheritDoc
     */
    public function get($synamenContactsId)
    {
        $synamenContacts = $this->synamenContactsFactory->create();
        $this->resource->load($synamenContacts, $synamenContactsId);
        if (!$synamenContacts->getId()) {
            throw new NoSuchEntityException(__('synamen_contacts with id "%1" does not exist.', $synamenContactsId));
        }
        return $synamenContacts;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->synamenContactsCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(
        SynamenContactsInterface $synamenContacts
    ) {
        try {
            $synamenContactsModel = $this->synamenContactsFactory->create();
            $this->resource->load($synamenContactsModel, $synamenContacts->getSynamenContactsId());
            $this->resource->delete($synamenContactsModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the synamen_contacts: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($synamenContactsId)
    {
        return $this->delete($this->get($synamenContactsId));
    }
}

