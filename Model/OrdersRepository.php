<?php


namespace ALevel\QuickOrder\Model;


use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

use ALevel\QuickOrder\Api\Data\QuickOrderInterface;
use ALevel\QuickOrder\Api\Data\OrdersSearchResultsInterfaceFactory;
use ALevel\QuickOrder\Api\OrdersRepositoryInterface;
use ALevel\QuickOrder\Model\OrdersFactory;
use ALevel\QuickOrder\Model\ResourceModel\Orders as ResourceModel;
use ALevel\QuickOrder\Model\ResourceModel\Orders\CollectionFactory;

class OrdersRepository implements OrdersRepositoryInterface
{
    /** @var ResourceModel */
    protected $resource;

    /** @var OrdersFactory  */
    protected $ordersFactory;

    /** @var CollectionProcessorInterface */
    protected $collectionProcessor;

    /** @var CollectionFactory */
    protected $collectionFactory;

    /** @var OrdersSearchResultsInterfaceFactory */
    protected $searchResultsFactory;

    public function __construct(
        ResourceModel $resource,
        OrdersFactory $ordersFactory,
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory,
        OrdersSearchResultsInterfaceFactory $ordersSearchResultsFactory
    ) {
        $this->resource                 = $resource;
        $this->ordersFactory            = $ordersFactory;
        $this->collectionProcessor      = $collectionProcessor;
        $this->collectionFactory        = $collectionFactory;
        $this->searchResultsFactory     = $ordersSearchResultsFactory;
    }

    /** {@inheritdoc} */
    public function getById($id)
    {
        $orders = $this->ordersFactory->create();
        $this->resource->load($orders, $id);

        if (!$orders->getId()) {
            throw new NoSuchEntityException(__('Order with id "%1" does not exist.', $id));
        }

        return $orders;
    }

    /** {@inheritdoc} */
    public function deleteById($id)
    {
        $this->delete($this->getById($id));
    }

    /** {@inheritdoc} */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /** {@inheritdoc} */
    public function save(QuickOrderInterface $orders)
    {
        try {
            $this->resource->save($orders);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $orders;
    }

    /** {@inheritdoc} */
    public function delete(QuickOrderInterface $orders)
    {
        try {
            $this->resource->delete($orders);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return $this;
    }
}