<?php

namespace Synamen\GoogleContent\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Synamen\GoogleContent\Api\MappingRepositoryInterface;
use Synamen\GoogleContent\Model\ResourceModel\Mapping as MappingResource;
use Synamen\GoogleContent\Model\MappingFactory;
use Synamen\GoogleContent\Model\ResourceModel\Mapping\CollectionFactory as MappingCollectionFactory;

class MappingRepository implements MappingRepositoryInterface
{
    /**
     * @var MappingResource
     */
    protected $resource;

    /**
     * @var \Synamen\GoogleContent\Model\MappingFactory
     */
    protected $mappingFactory;

    /**
     * @var ExportCollectionFactory
     */
    protected $mappingCollectionFactory;

    /**
     * MappingRepository constructor.
     * @param MappingResource $resource
     * @param \Synamen\GoogleContent\Model\MappingFactory $mappingFactory
     * @param MappingCollectionFactory $mappingCollectionFactory
     */
    public function __construct(
        MappingResource $resource,
        MappingFactory $mappingFactory,
        MappingCollectionFactory $mappingCollectionFactory
    ) {
        $this->resource                 = $resource;
        $this->mappingFactory           = $mappingFactory;
        $this->mappingCollectionFactory = $mappingCollectionFactory;
    }

    /**
     * Save method.
     * @param \Synamen\GoogleContent\Api\Data\MappingInterface $mapping
     * @return \Synamen\GoogleContent\Api\Data\MappingInterface
     * @throws CouldNotSaveException
     */
    public function save(\Synamen\GoogleContent\Api\Data\MappingInterface $mapping)
    {
        try {
            $this->resource->save($mapping);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __(
                    'Could not save the mapping: %1',
                    $exception->getMessage()
                )
            );
        }
        return $mapping;
    }

    /**
     * GetById method.
     * @param $mappingId
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($mappingId)
    {
        $mapping = $this->mappingFactory->create();
        $this->resource->load($mapping, $mappingId);
        if (!$mapping->getId()) {
            throw new NoSuchEntityException(__('Mapping with id "%1" does not exist.', $mappingId));
        }
        return $mapping;
    }

    /**
     * Delete Method.
     * @param \Synamen\GoogleContent\Api\Data\MappingInterface $mapping
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\Synamen\GoogleContent\Api\Data\MappingInterface $mapping)
    {
        try {
            $this->resource->delete($mapping);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __(
                    'Could not delete the mapping: %1',
                    $exception->getMessage()
                )
            );
        }
        return true;
    }

    /**
     * DeleteById Method. 
     * @param int $mappingId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($mappingId)
    {
        return $this->delete($this->getById($mappingId));
    }
}
