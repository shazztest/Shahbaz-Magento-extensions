<?php
declare(strict_types=1);

namespace Synamen\Contact\Model;

use Magento\Framework\Model\AbstractModel;
use Synamen\Contact\Api\Data\SynamenContactsInterface;

class SynamenContacts extends AbstractModel implements SynamenContactsInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Synamen\Contact\Model\ResourceModel\SynamenContacts::class);
    }

    /**
     * @inheritDoc
     */
    public function getSynamenContactsId()
    {
        return $this->getData(self::SYNAMEN_CONTACTS_ID);
    }

    /**
     * @inheritDoc
     */
    public function setSynamenContactsId($synamenContactsId)
    {
        return $this->setData(self::SYNAMEN_CONTACTS_ID, $synamenContactsId);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheritDoc
     */
    public function getTelephone()
    {
        return $this->getData(self::TELEPHONE);
    }

    /**
     * @inheritDoc
     */
    public function setTelephone($telephone)
    {
        return $this->setData(self::TELEPHONE, $telephone);
    }

    /**
     * @inheritDoc
     */
    public function getSubject()
    {
        return $this->getData(self::SUBJECT);
    }

    /**
     * @inheritDoc
     */
    public function setSubject($subject)
    {
        return $this->setData(self::SUBJECT, $subject);
    }

    /**
     * @inheritDoc
     */
    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * @inheritDoc
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * @inheritDoc
     */
    public function getCustomOption()
    {
        return $this->getData(self::CUSTOM_OPTION);
    }

    /**
     * @inheritDoc
     */
    public function setCustomOption($customOption)
    {
        return $this->setData(self::CUSTOM_OPTION, $customOption);
    }

    /**
     * @inheritDoc
     */
    public function getCheckBox()
    {
        return $this->getData(self::CHECK_BOX);
    }

    /**
     * @inheritDoc
     */
    public function setCheckBox($checkBox)
    {
        return $this->setData(self::CHECK_BOX, $checkBox);
    }

    /**
     * @inheritDoc
     */
    public function getDate()
    {
        return $this->getData(self::DATE);
    }

    /**
     * @inheritDoc
     */
    public function setDate($date)
    {
        return $this->setData(self::DATE, $date);
    }
}

