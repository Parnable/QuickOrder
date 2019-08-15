<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2018, Pavel Usachev
 */

namespace ALevel\QuickOrder\Controller\Adminhtml\Orders;

use ALevel\QuickOrder\Controller\Adminhtml\Orders;

class Index extends Orders
{
    const ACL_RESOURCE      = 'ALevel_QuickOrder::orders_grid';
    const MENU_ITEM         = 'ALevel_QuickOrder::orders_grid';
    const PAGE_TITLE        = 'Orders Grid';
    const BREADCRUMB_TITLE  = 'Orders Grid';
}
