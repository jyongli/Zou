<?php
namespace Zou\Demo\Controller\Adminhtml\PhysicalStoreEvaluate;
class Grid extends \Zou\Demo\Controller\Adminhtml\PhysicalStoreEvaluate
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $resultLayout = $this->_resultLayoutFactory->create();
        
        return $resultLayout;
    }
}
