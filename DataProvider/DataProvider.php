<?php


namespace ALevel\QuickOrder\DataProvider;


use Magento\Ui\DataProvider\AbstractDataProvider;
use ALevel\QuickOrder\Api\Data\QuickOrderInterface;
use ALevel\QuickOrder\Api\Data\StatusInterface;
use ALevel\QuickOrder\Model\ResourceModel\Orders\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @param string            $name
     * @param string            $primaryFieldName
     * @param string            $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array             $meta
     * @param array             $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getOrdersData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        if (empty($items)) {
            return [];
        }

        /** @var $order QuickOrderInterface */
        foreach ($items as $order) {
            $this->loadedData[$order->getId()] = $order->getData();
        }

        return $this->loadedData;
    }

    public function getStatusesData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        if (empty($items)) {
            return [];
        }

        /** @var $status StatusInterface */
        foreach ($items as $status) {
            $this->loadedData[$status->getId()] = $status->getData();
        }

        return $this->loadedData;
    }
}