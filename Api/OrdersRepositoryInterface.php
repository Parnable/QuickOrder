<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace ALevel\QuickOrder\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;

use ALevel\QuickOrder\Api\Data\QuickOrderInterface;
use ALevel\QuickOrder\Api\Data\OrdersSearchResultsInterface;

interface OrdersRepositoryInterface
{
    /**
     * @param int $id
     * @return QuickOrderInterface
     * @throws NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param int $id
     * @return OrdersRepositoryInterface
     */
    public function deleteById($id);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return OrdersSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param QuickOrderInterface $orders
     * @return QuickOrderInterface
     * @throws CouldNotSaveException
     */
    public function save(\ALevel\QuickOrder\Api\Data\QuickOrderInterface $orders);

    /**
     * @param QuickOrderInterface $orders
     * @return OrdersRepositoryInterface
     * @throws CouldNotDeleteException
     */
    public function delete(\ALevel\QuickOrder\Api\Data\QuickOrderInterface $orders);
}
