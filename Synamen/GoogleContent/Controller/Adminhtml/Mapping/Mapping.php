<?php

namespace Synamen\GoogleContent\Controller\Adminhtml\Mapping;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Synamen\GoogleContent\Model\MappingFactory;
use Magento\Framework\Serialize\SerializerInterface;
use Synamen\GoogleContent\Api\MappingRepositoryInterface;

abstract class Mapping extends Action
{
    const ADMIN_RESOURCE = 'Synamen_GoogleContent::synamen_feeds';
    const INDEX_PAGE_URL = 'synamen_feeds/mapping/index';
    const EDIT_PAGE_URL = 'synamen_feeds/mapping/edit';

    /**
     * @var MappingFactory
     */
    protected $mappingFactory;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var MappingRepositoryInterface
     */
    protected $repository;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Mapping constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param MappingFactory $mappingFactory
     * @param SerializerInterface $serializer
     * @param MappingRepositoryInterface $repository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        MappingFactory $mappingFactory,
        SerializerInterface $serializer,
        MappingRepositoryInterface $repository
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->mappingFactory = $mappingFactory;
        $this->serializer = $serializer;
        $this->repository = $repository;
    }
}
