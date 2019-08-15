<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace ALevel\QuickOrder\Controller\Adminhtml\Orders;

use Magento\Framework\Exception\NoSuchEntityException;

use ALevel\QuickOrder\Api\Data\QuickOrderInterface;
use ALevel\QuickOrder\Controller\Adminhtml\Orders as BaseAction;

class Edit extends BaseAction
{
    const ACL_RESOURCE      = 'ALevel_QuickOrder::edit';
    const MENU_ITEM         = 'ALevel_QuickOrder::edit';
    const PAGE_TITLE        = 'Edit Order';
    const BREADCRUMB_TITLE  = 'Edit Order';

    /** {@inheritdoc} */
    public function execute()
    {
        $id = $this->getRequest()->getParam(static::QUERY_PARAM_ID);

        if (!empty($id)) {
            try {
                $model = $this->repository->getById($id);
            } catch (NoSuchEntityException $exception) {
                $this->logger->error($exception->getMessage());
                $this->messageManager->addErrorMessage(__('Entity with id %1 not found', $id));
                return $this->redirectToGrid();
            }

        } else {
            $this->logger->error(
                sprintf("Require parameter `%s` is missing", static::QUERY_PARAM_ID)
            );
            $this->messageManager->addErrorMessage("Order not found");
            return $this->redirectToGrid();
        }

        $data = $this->_session->getFormData(true);

        if (!empty($data)) {
            $model->setData($data);
        }

        $this->registry->register(QuickOrderInterface::REGISTRY_KEY, $model);

        return parent::execute();
    }
}
