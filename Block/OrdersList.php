<?php


namespace ALevel\QuickOrder\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Api\SearchCriteriaBuilder;

use ALevel\QuickOrder\Api\OrdersRepositoryInterface;


class OrdersList extends Template
{
    /** @var SearchCriteriaBuilder */
    protected $searchCriteria;

    /** @var OrdersRepositoryInterface */
    protected $repository;

    /**
     * @param Context                       $context
     * @param OrdersRepositoryInterface    $lessonsRepository
     * @param SearchCriteriaBuilder         $searchCriteriaBuilder
     * @param array                         $data
     */
    public function __construct(
        Context $context,
        OrdersRepositoryInterface $ordersRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        $this->repository       = $ordersRepository;
        $this->searchCriteria   = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }
}