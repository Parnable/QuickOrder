<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace ALevel\QuickOrder\Model\ResourceModel\Orders;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use ALevel\QuickOrder\Model\Orders as Model;
use ALevel\QuickOrder\Model\ResourceModel\Orders as ResourceModel;

class Collection extends AbstractCollection
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
