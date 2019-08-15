<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

namespace ALevel\QuickOrder\Controller\Adminhtml\Orders;

use ALevel\QuickOrder\Controller\Adminhtml\Orders as BaseAction;

class MassDelete extends BaseAction
{
    /** {@inheritdoc} */
    public function execute()
    {
        $ids = $this->getRequest()->getParam('ids');
        if (count($ids)) {
            foreach ($ids as $id) {
                try {
                    $this->repository->deleteById($id);
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                    $this->logger->critical(
                        sprintf("Can\'t delete order: %d", $id)
                    );
                    $this->messageManager->addErrorMessage(__('Order with id %1 not deleted', $id));
                }
            }
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) has been deleted.', count($ids))
            );
        } else {
            $this->logger->error("Parameter ids must be array and not empty");
            $this->messageManager->addWarningMessage("Please select items to delete");
        }

        return $this->redirectToGrid();
    }
}
