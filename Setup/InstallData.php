<?php


namespace ALevel\QuickOrder\Setup;

use Psr\Log\LoggerInterface;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Transaction;
use Magento\Framework\DB\TransactionFactory;

use ALevel\QuickOrder\Api\Data\QuickOrderInterface;
use ALevel\QuickOrder\Api\Data\QuickOrderInterfaceFactory;
use ALevel\QuickOrder\Api\Data\StatusInterface;
use ALevel\QuickOrder\Api\Data\StatusInterfaceFactory;

/**
 * Class InstallData
 *
 * @package ALevel\QuickOrder\Setup
 */
class InstallData implements InstallDataInterface
{
    /** @var QuickOrderInterfaceFactory  */
    private $ordersFactory;

    /** @var StatusInterfaceFactory     */
    private $statusesFactory;

    /** @var TransactionFactory */
    private $transactionFactory;

    /** LoggerInterface */
    private $logger;

    public function __construct(
        QuickOrderInterfaceFactory $ordersFactory,
        StatusInterfaceFactory $statusesFactory,
        TransactionFactory $transactionFactory,
        LoggerInterface $logger
    ) {
        $this->ordersFactory        = $ordersFactory;
        $this->statusesFactory      = $statusesFactory;
        $this->transactionFactory   = $transactionFactory;
        $this->logger               = $logger;
    }

    /** {@inheritdoc} */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var Transaction $transactionalModel */
        $transactionalModel = $this->transactionFactory->create();

        $startDate = new \DateTimeImmutable();
        $endDate = $startDate->add(new \DateInterval('P7D'));

        for ($i = 1; $i < 5; $i++) {
            /** @var QuickOrderInterface $order */
            $order = $this->ordersFactory->create();
            $order->setSku('039845794875'.$i);
            $order->setName(sprintf("Customer Ivan %d", $i));
            $order->setPhone('+380933458743'.$i);
            $order->setCreatedAt($startDate);
            $order->setUpdatedAt($endDate);

            $transactionalModel->addObject($order);
        }

        for ($i = 1; $i < 5; $i++) {
            /** @var StatusInterface $status*/
            $status = $this->statusesFactory->create();
            $status->setStatusId($i);
            switch ($i){
                case 1:
                    $status->setStatus('Pending');
                    break;
                case 2:
                    $status->setStatus('Approved');
                    break;
                case 3:
                    $status->setStatus('Cancelled');
                    break;
                case 4:
                    $status->setStatus('Shipped');
                    break;
            }

            $status->setCreatedAt($startDate);
            $status->setUpdatedAt($endDate);

            $transactionalModel->addObject($status);
        }

        try {
            $transactionalModel->save();
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}