<?php

namespace Synamen\GoogleContent\Api\Data;

interface MappingInterface
{
    const ID = 'id';
    const TITLE = 'title';
    const TYPE_ID = 'type_id';
    const MAPPING_DATA = 'mapping_data';
    const RH_PRODUCTS = 'rh_products';
    const CREDENTIALS_DATA = 'credentials_data';
    const TABLE_NAME = 'synamen_feed_category_mapping';

    /**
     * @return int|null
     */
    public function getId();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return int
     */
    public function getTypeId();

    /**
     * @return string|null
     */
    public function getCredentialsData();

    /**
     * @return string
     */
    public function getMappingData();

    /**
     * @return string
     */
    public function getRhProducts();

    /**
     * @param $mappingId
     * @return MappingInterface
     */
    public function setId($mappingId);

    /**
     * @param $title
     * @return MappingInterface
     */
    public function setTitle($title);

    /**
     * @param $feedId
     * @return MappingInterface
     */
    public function setTypeId($feedId);

    /**
     * @param $credentials
     * @return MappingInterface
     */
    public function setCredentialsData($credentials);

    /**
     * @param $mapping
     * @return MappingInterface
     */
    public function setMappingData($mapping);

    /**
     * @param $product
     * @return MappingInterface
     */
    public function setRhProducts($product);
}
