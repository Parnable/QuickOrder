<?php


namespace ALevel\QuickOrder\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

use ALevel\QuickOrder\Api\Data\QuickOrderInterface;

class Orders extends AbstractDb
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(QuickOrderInterface::TABLE_NAME, QuickOrderInterface::ID_FIELD);
    }
}