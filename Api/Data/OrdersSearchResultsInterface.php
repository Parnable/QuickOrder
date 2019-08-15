<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace ALevel\QuickOrder\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface OrdersSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get orders list.
     *
     * @return QuickOrderInterface[]
     */
    public function getItems();

    /**
     * Set orders list.
     *
     * @param QuickOrderInterface[] $items
     * @return OrdersSearchResultsInterface
     */
    public function setItems(array $items);
}
