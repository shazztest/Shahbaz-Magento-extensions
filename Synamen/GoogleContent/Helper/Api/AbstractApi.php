<?php

namespace Synamen\GoogleContent\Helper\Api;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Synamen\GoogleContent\Helper\Data;

abstract class AbstractApi extends AbstractHelper
{
    /**
     * @var Data
     */
    public $helper;

    /**
     * AbstractApi constructor.
     *
     * @param Context $context
     * @param Data $helper
     */
    public function __construct(
        Context $context,
        Data $helper
    ) {
        parent::__construct($context);

        $this->helper = $helper;
    }

    /**
     * Get feed categories
     *
     * @param mixed $formData
     * @param $id
     * @param $typeId
     * @return mixed
     */
    abstract public function getCategory($formData, $id, $typeId);
}
