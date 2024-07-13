<?php
declare(strict_types=1);

namespace Synamen\Contact\Api\Data;

interface SynamenContactsInterface
{

    const CHECK_BOX = 'check_box';
    const CUSTOM_OPTION = 'Custom_option';
    const DATE = 'date';
    const SUBJECT = 'Subject';
    const NAME = 'Name';
    const COMMENT = 'Comment';
    const SYNAMEN_CONTACTS_ID = 'synamen_contacts_id';
    const EMAIL = 'Email';
    const TELEPHONE = 'Telephone';

    /**
     * Get synamen_contacts_id
     * @return string|null
     */
    public function getSynamenContactsId();

    /**
     * Set synamen_contacts_id
     * @param string $synamenContactsId
     * @return \Synamen\Contact\SynamenContacts\Api\Data\SynamenContactsInterface
     */
    public function setSynamenContactsId($synamenContactsId);

    /**
     * Get Name
     * @return string|null
     */
    public function getName();

    /**
     * Set Name
     * @param string $name
     * @return \Synamen\Contact\SynamenContacts\Api\Data\SynamenContactsInterface
     */
    public function setName($name);

    /**
     * Get Email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set Email
     * @param string $email
     * @return \Synamen\Contact\SynamenContacts\Api\Data\SynamenContactsInterface
     */
    public function setEmail($email);

    /**
     * Get Telephone
     * @return string|null
     */
    public function getTelephone();

    /**
     * Set Telephone
     * @param string $telephone
     * @return \Synamen\Contact\SynamenContacts\Api\Data\SynamenContactsInterface
     */
    public function setTelephone($telephone);

    /**
     * Get Subject
     * @return string|null
     */
    public function getSubject();

    /**
     * Set Subject
     * @param string $subject
     * @return \Synamen\Contact\SynamenContacts\Api\Data\SynamenContactsInterface
     */
    public function setSubject($subject);

    /**
     * Get Comment
     * @return string|null
     */
    public function getComment();

    /**
     * Set Comment
     * @param string $comment
     * @return \Synamen\Contact\SynamenContacts\Api\Data\SynamenContactsInterface
     */
    public function setComment($comment);

    /**
     * Get Custom_option
     * @return string|null
     */
    public function getCustomOption();

    /**
     * Set Custom_option
     * @param string $customOption
     * @return \Synamen\Contact\SynamenContacts\Api\Data\SynamenContactsInterface
     */
    public function setCustomOption($customOption);

    /**
     * Get check_box
     * @return string|null
     */
    public function getCheckBox();

    /**
     * Set check_box
     * @param string $checkBox
     * @return \Synamen\Contact\SynamenContacts\Api\Data\SynamenContactsInterface
     */
    public function setCheckBox($checkBox);

    /**
     * Get date
     * @return string|null
     */
    public function getDate();

    /**
     * Set date
     * @param string $date
     * @return \Synamen\Contact\SynamenContacts\Api\Data\SynamenContactsInterface
     */
    public function setDate($date);
}

