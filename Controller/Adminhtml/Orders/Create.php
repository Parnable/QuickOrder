<?php


namespace ALevel\QuickOrder\Controller\Adminhtml\Orders;


use ALevel\QuickOrder\Api\Data\QuickOrderInterface;
use ALevel\QuickOrder\Controller\Adminhtml\Orders as BaseAction;

class Create extends BaseAction
{
    const ACL_RESOURCE      = 'ALevel_QuickOrder::create';
    const MENU_ITEM         = 'ALevel_QuickOrder::create';
    const PAGE_TITLE        = 'Add Order';
    const BREADCRUMB_TITLE  = 'Add Order';

    /** {@inheritdoc} */
    public function execute()
    {
        $model = $this->getModel();

        $data = $this->_session->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }
        $this->registry->register(QuickOrderInterface::REGISTRY_KEY, $model);

        return parent::execute();
    }
}