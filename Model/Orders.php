<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace ALevel\QuickOrder\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Stdlib\DateTime;

use ALevel\QuickOrder\Api\Data\QuickOrderInterface;
use ALevel\QuickOrder\Model\ResourceModel\Orders as ResourceModel;

class Orders extends AbstractModel implements QuickOrderInterface, IdentityInterface
{
    /** {@inheritdoc} */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s", QuickOrderInterface::CACHE_TAG, $this->getId())];
    }

    /** {@inheritdoc} */
    public function getSku()
    {
        return $this->getData(QuickOrderInterface::PRODUCT_SKU);
    }

    /** {@inheritdoc} */
    public function setSku($sku)
    {
        $this->setData(QuickOrderInterface::PRODUCT_SKU, $sku);

        return $this;
    }

    /** {@inheritdoc} */
    public function getName()
    {
        return $this->getData(QuickOrderInterface::CUSTOMER_NAME);
    }

    /** {@inheritdoc} */
    public function setName($name)
    {
        $this->setData(QuickOrderInterface::CUSTOMER_NAME, $name);

        return $this;
    }

    /** {@inheritdoc} */
    public function getPhone()
    {
        return $this->getData(QuickOrderInterface::CUSTOMER_PHONE);
    }

    /** {@inheritdoc} */
    public function setPhone($phone)
    {
        $this->setData(QuickOrderInterface::CUSTOMER_PHONE, $phone);

        return $this;
    }

    /** {@inheritdoc} */
    public function getEmail()
    {
        return $this->getData(QuickOrderInterface::CUSTOMER_EMAIL);
    }

    /** {@inheritdoc} */
    public function setEmail($email)
    {
        $this->setData(QuickOrderInterface::CUSTOMER_EMAIL, $email);

        return $this;
    }

    /** {@inheritdoc} */
    public function getCreatedAt()
    {
        return $this->getData(QuickOrderInterface::CREATED_AT);
    }

    /** {@inheritdoc} */
    public function setCreatedAt($createdAt)
    {
        if ($createdAt instanceof \DateTime) {
            $createdAt = $createdAt->format(DateTime::DATETIME_PHP_FORMAT);
        }

        $this->setData(QuickOrderInterface::CREATED_AT, $createdAt);

        return $this;
    }

    /** {@inheritdoc} */
    public function getUpdatedAt()
    {
        return $this->getData(QuickOrderInterface::UPDATED_AT);
    }

    /** {@inheritdoc} */
    public function setUpdatedAt($updatedAt)
    {
        if ($updatedAt instanceof \DateTime) {
            $updatedAt = $updatedAt->format(DateTime::DATETIME_PHP_FORMAT);
        }

        $this->setData(QuickOrderInterface::UPDATED_AT, $updatedAt);

        return $this;
    }
}
