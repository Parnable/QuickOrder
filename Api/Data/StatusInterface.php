<?php


namespace ALevel\QuickOrder\Api\Data;


interface StatusInterface
{
    const TABLE_NAME                = 'alevel_quickorder_statuses';

    const ID_FIELD                  = 'status_id';
    const STATUS                    = 'status';
    const UPDATED_AT                = 'created_at';
    const CREATED_AT                = 'updated_at';

    const CACHE_TAG                 = 'alevel_quickorder';

    /**
     * @return mixed
     */
    public function getId();

    /*
     * param mixed $statusId
     * @return StatusInterface
     */
    public function setStatusId($statusId);

    /**
     * @return mixed
     */
    public function getStatus();

    /**
     * @param mixed $status
     * @return StatusInterface
     */
    public function setStatus($status);

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @param \DateTime|string $createdAt
     * @return StatusInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * @param \DateTime|string $updatedAt
     * @return StatusInterface
     */
    public function setUpdatedAt($updatedAt);
}