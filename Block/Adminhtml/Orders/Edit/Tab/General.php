<?php


namespace ALevel\QuickOrder\Block\Adminhtml\Orders\Edit\Tab;


use ALevel\QuickOrder\Api\Data\QuickOrderInterface;

class General extends AbstractTab
{
    const TAB_LABEL     = 'General';
    const TAB_TITLE     = 'General';

    /** {@inheritdoc} */
    protected function _prepareForm()
    {
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('order_');
        $form->setFieldNameSuffix('order');

        $fieldSet = $form->addFieldset(
            'general_fieldset',
            ['legend' => __('General')]
        );

        if ($this->model->getData(QuickOrderInterface::ID_FIELD)) {
            $fieldSet->addField(
                QuickOrderInterface::ID_FIELD,
                'hidden',
                ['name' => QuickOrderInterface::ID_FIELD]
            );
        }

        $fieldSet->addField(
            QuickOrderInterface::PRODUCT_SKU,
            'text',
            [
                'name'      => QuickOrderInterface::PRODUCT_SKU,
                'label'     => __('SKU'),
                'required'  => true
            ]
        );

        $fieldSet->addField(
            QuickOrderInterface::CUSTOMER_NAME,
            'text',
            [
                'name'      => QuickOrderInterface::CUSTOMER_NAME,
                'label'     => __('Customer name'),
                'required'  => true
            ]
        );

        $fieldSet->addField(
            QuickOrderInterface::CUSTOMER_PHONE,
            'editor',
            [
                'name'      => QuickOrderInterface::CUSTOMER_PHONE,
                'label'     => __('Customer phone'),
                'required'  => true,
                'config'    => $this->wysiwygConfig->getConfig()
            ]
        );

        $fieldSet->addField(
            QuickOrderInterface::CUSTOMER_EMAIL,
            'editor',
            [
                'name'      => QuickOrderInterface::CUSTOMER_EMAIL,
                'label'     => __('Customer email'),
                'required'  => true,
                'config'    => $this->wysiwygConfig->getConfig()
            ]
        );

        $fieldSet->addField(
            QuickOrderInterface::CREATED_AT,
            'date',
            [
                'name'          => QuickOrderInterface::CREATED_AT,
                'label'         => __('Start'),
                'date_format'   => 'yyyy-MM-dd',
                'time_format'   => 'hh:mm:ss',
                'required'      => true
            ]
        );

        $fieldSet->addField(
            QuickOrderInterface::UPDATED_AT,
            'date',
            [
                'name'          => QuickOrderInterface::UPDATED_AT,
                'label'         => __('End'),
                'date_format'   => 'yyyy-MM-dd',
                'time_format'   => 'hh:mm:ss',
                'required'      => true
            ]
        );

        $data = $this->model->getData();

        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}