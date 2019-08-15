<?php


namespace ALevel\QuickOrder\Block\Adminhtml\Orders\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class   SaveButton extends GenericButton implements ButtonProviderInterface
{
    /** {@inheritdoc} */
    public function getButtonData()
    {
        return [
            'label' => __('Save Order'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}