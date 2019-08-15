<?php


namespace ALevel\QuickOrder\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;

use ALevel\QuickOrder\Api\Data\QuickOrderInterface;
use ALevel\QuickOrder\Api\Data\StatusInterface;

class InstallSchema implements InstallSchemaInterface
{
    /** {@inheritdoc} */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /** create table `alevel_quickorder_orders` */
        $table = $installer->getConnection()->newTable(
            $installer->getTable(QuickOrderInterface::TABLE_NAME)
        )->addColumn(
            QuickOrderInterface::ID_FIELD,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
            'Order ID'
        )->addColumn(
            QuickOrderInterface::PRODUCT_SKU,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Product SKU'
        )->addColumn(
            QuickOrderInterface::CUSTOMER_NAME,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Customer name'
        )->addColumn(
            QuickOrderInterface::CUSTOMER_PHONE,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Customer phone'
        )->addColumn(
            QuickOrderInterface::CUSTOMER_EMAIL,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Customer e-mail'
        )->addColumn(
            QuickOrderInterface::CREATED_AT,
            Table::TYPE_DATETIME,
            null,
            ['nullable' => false],
            'Order created'
        )->addColumn(
            QuickOrderInterface::UPDATED_AT,
            Table::TYPE_DATETIME,
            null,
            ['nullable' => false],
            'Order updated'
        )->addIndex(
            $setup->getIdxName(
                $installer->getTable(QuickOrderInterface::TABLE_NAME),
                [QuickOrderInterface::CUSTOMER_NAME],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            [QuickOrderInterface::CUSTOMER_NAME],
            ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
        )->setComment(
            'ALevel QuickOrder Orders Table'
        );

        /** create table `alevel_quickorder_statuses` */
        $table2 = $installer->getConnection()->newTable(
            $installer->getTable(StatusInterface::TABLE_NAME)
        )->addColumn(
            StatusInterface::ID_FIELD,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
            'Status ID'
        )->addColumn(
            StatusInterface::STATUS,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Status name'
        )->addColumn(
            StatusInterface::CREATED_AT,
            Table::TYPE_DATETIME,
            null,
            ['nullable' => false],
            'Status created'
        )->addColumn(
            StatusInterface::UPDATED_AT,
            Table::TYPE_DATETIME,
            null,
            ['nullable' => false],
            'Status updated'
        )->setComment(
            'ALevel QuickOrder Statuses Table'
        );

        $installer->getConnection()->createTable($table);
        $installer->getConnection()->createTable($table2);

        $installer->endSetup();
    }
}