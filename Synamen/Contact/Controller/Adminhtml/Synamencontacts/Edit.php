<?php
declare(strict_types=1);

namespace Synamen\Contact\Controller\Adminhtml\Synamencontacts;

class Edit extends \Synamen\Contact\Controller\Adminhtml\Synamencontacts
{

    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('synamen_contacts_id');
        $model = $this->_objectManager->create(\Synamen\Contact\Model\SynamenContacts::class);
        
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Synamen Contacts no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('synamen_contact_synamen_contacts', $model);
        
        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Synamen Contacts') : __('New Synamen Contacts'),
            $id ? __('Edit Synamen Contacts') : __('New Synamen Contacts')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Synamen Contactss'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Synamen Contacts %1', $model->getId()) : __('New Synamen Contacts'));
        return $resultPage;
    }
}

