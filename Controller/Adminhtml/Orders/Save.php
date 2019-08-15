<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace ALevel\QuickOrder\Controller\Adminhtml\Orders;

use ALevel\QuickOrder\Api\Data\QuickOrderInterface;
use ALevel\QuickOrder\Controller\Adminhtml\Orders as BaseAction;

class Save extends BaseAction
{
    /** {@inheritdoc} */
    public function execute()
    {
        $isPost = $this->getRequest()->isPost();

        if ($isPost) {
            $model = $this->getModel();
            $formData = $this->getRequest()->getParam('order');

            if (empty($formData)) {
                $formData = $this->getRequest()->getParams();
            }

            if(!empty($formData[QuickOrderInterface::ID_FIELD])) {
                $id = $formData[QuickOrderInterface::ID_FIELD];
                $model = $this->repository->getById($id);
            } else {
                unset($formData[QuickOrderInterface::ID_FIELD]);
            }

            $model->setData($formData);

            try {
                $model = $this->repository->save($model);
                $this->messageManager->addSuccessMessage(__('Order has been saved.'));
                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }

                return $this->redirectToGrid();
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage(__('Order\'s saving failed' ));
            }

            $this->_getSession()->setFormData($formData);

            return (!empty($model->getId())) ?
                $this->_redirect('*/*/edit', ['id' => $model->getId()])
                : $this->_redirect('*/*/create');
        }

        return $this->doRefererRedirect();
    }
}
