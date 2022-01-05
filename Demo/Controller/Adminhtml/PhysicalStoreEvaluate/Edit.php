<?php
namespace Zou\Demo\Controller\Adminhtml\PhysicalStoreEvaluate;

class Edit extends \Zou\Demo\Controller\Adminhtml\PhysicalStoreEvaluate
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $id = $this->getRequest()->getParam('id');

        $model = $this->_physicalStoreEvaluateFactory->create();
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This physicalStoreEva no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('physicalStoreEvaluate', $model);

        return $resultPage;
    }
}
