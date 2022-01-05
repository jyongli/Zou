<?php
namespace Zou\Demo\Controller\Adminhtml\PhysicalStoreEvaluate;

use Zou\Demo\Model\PhysicalStore;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Zou\Demo\Controller\Adminhtml\PhysicalStoreEvaluate
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $formPostValues = $this->getRequest()->getPostValue();
        if ($formPostValues) {
            $physicalStoreData = $formPostValues;//$formPostValues['physicalStore'];
            $physicalStoreData['store_id'] = $physicalStoreData['mage_store_ids'];
            unset($physicalStoreData['mage_store_ids']);
            $physicalStoreId = isset($physicalStoreData['id']) ? $physicalStoreData['id'] : null;

            $model = $this->_physicalStoreEvaluateFactory->create();
            $model->load($physicalStoreId);
            $model->setData($physicalStoreData);
            try {
                $model->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->_getSession()->setFormData(false);

                return $this->_getBackResultRedirect($resultRedirect, $model->getId());
            } catch (\Exception $e) {
//                 echo $e->getMessage();die;
                $this->messageManager->addError($e->getMessage());
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->_getSession()->setFormData($formPostValues);

            return $resultRedirect->setPath('*/*/edit', [static::PARAM_CRUD_ID => $physicalStoreId]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
