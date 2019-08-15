<?php


namespace ALevel\QuickOrder\Block\Adminhtml\Orders\Edit;


use ALevel\QuickOrder\Block\Adminhtml\Orders\Edit\Tab\General as GeneralTab;

class Tabs
{
    /** {@inheritdoc} */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('alevel_quickorder_orders_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Order information'));
    }
    /**
     * @return \ALevel\QuickOrder\Block\Adminhtml\Orders\Edit\Tabs
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'general_info',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock(
                    GeneralTab::class
                )->toHtml(),
                'active' => true
            ]
        );

        return parent::_beforeToHtml();
    }
}