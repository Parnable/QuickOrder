<?php


namespace ALevel\QuickOrder\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class OrdersGrid extends Container
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_orders';
        $this->_blockGroup = 'ALevel_QuickOrder';
        $this->_headerText = __('Orders');
        $this->_addButtonLabel = __('Create new');
        parent::_construct();
    }

    /** {@inheritdoc} */
    public function getCreateUrl()
    {
        return $this->getUrl('*/*/create');
    }
}