<?php
namespace Zou\Demo\Controller\Adminhtml\PhysicalStoreEvaluate;

class Index extends \Zou\Demo\Controller\Adminhtml\PhysicalStoreEvaluate
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        if ($this->getRequest()->getQuery('ajax') ) {

            $resultForward = $this->_resultForwardFactory->create();
            $resultForward->forward('grid');
            
            return $resultForward;
        }

        $resultPage = $this->_resultPageFactory->create();

        return $resultPage;
    }
}
