<?php


namespace ALevel\QuickOrder\Api\Data;


interface QuickOrderInterface
{
    const TABLE_NAME                = 'alevel_quickorder_orders';

    const ID_FIELD                  = 'order_id';
    const PRODUCT_SKU               = 'product_sku';
    const CUSTOMER_NAME             = 'customer_name';
    const CUSTOMER_PHONE            = 'customer_phone';
    const CUSTOMER_EMAIL            = 'customer_email';
    const UPDATED_AT                = 'created_at';
    const CREATED_AT                = 'updated_at';
    const STATUS_ID                 = 'status_id';

    const CACHE_TAG                 = 'alevel_quickorder';

    const REGISTRY_KEY              = 'alevel_quickorder_order';

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getSku();

    /**
     * @param mixed $sku
     * @return QuickOrderInterface
     */
    public function setSku($sku);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return QuickOrderInterface
     */
    public function setName($name);

    /**
     * @return mixed
     */
    public function getPhone();

    /**
     * @param mixed $phone
     * @return QuickOrderInterface
     */
    public function setPhone($phone);

    /**
     * @return mixed
     */
    public function getEmail();

    /**
     * @param mixed $email
     * @return QuickOrderInterface
     */
    public function setEmail($email);


    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @param \DateTime|string $createdAt
     * @return QuickOrderInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * @param \DateTime|string $updatedAt
     * @return QuickOrderInterface
     */
    public function setUpdatedAt($updatedAt);

}