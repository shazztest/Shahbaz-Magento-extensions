<?php

namespace Synamen\GoogleContent\Controller\Adminhtml\Ajax;

use Magento\Framework\Exception\NotFoundException;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Synamen\GoogleContent\Model\Mapping\FeedList;
use Synamen\GoogleContent\Helper\Data;
use Synamen\GoogleContent\Helper\Api\Google;

class Category extends Action
{
    /**
     * @var FeedList
     */
    protected $feedList;

    /**
     * @var Data
     */
    public $helper;

    /**
     * @var Google
     */
    protected $google;

    /**
     * Category constructor.
     * @param Context $context
     * @param Data $helper
     * @param FeedList $feedList
     * @param Google $google
     */
    public function __construct(
        Context $context,
        Data $helper,
        FeedList $feedList,
        Google $google
    ) {
        parent::__construct($context);

        $this->helper = $helper;
        $this->feedList = $feedList;
        $this->google = $google;
    }

    /**
     * @return ResponseInterface|ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $resultJson = $this->resultFactory->create($this->resultFactory::TYPE_JSON);
        if ($this->getRequest()->isAjax()) {
            $formData  = $this->getRequest()->getPost();
            return $resultJson->setData(
                [
                    'category' => $this->getCategoryByEntityFeed($formData)
                ]
            );
        }

        throw new NotFoundException(__('Ajax request only'));
    }

    /**
     * @param $formData
     * @return array|bool|float|int|mixed|string|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCategoryByEntityFeed($formData)
    {
        $typeId = $formData['type_id'];
        if (empty($formData['id'])) {
            $id = $this->helper->getNextEntityId();
        } else {
            $id = $formData['id'];
        }

        $categories = [];
        $feedList = $this->feedList->feeds;
        switch ($feedList[$typeId]) {
            case ('Google' || 'Facebook'):
                $categories = $this->google->getCategory($formData, $id, $typeId);
                break;
        }

        return $categories;
    }
}
