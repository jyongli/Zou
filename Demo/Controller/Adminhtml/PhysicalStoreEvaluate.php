<?php
namespace Zou\Demo\Controller\Adminhtml;
abstract class PhysicalStoreEvaluate extends \Magento\Backend\App\Action
{
    const PARAM_CRUD_ID = 'id';
    protected $_physicalStoreEvaluateFactory;
    protected $_physicalStoreEvaluateCollectionFactory;
    protected $_scopeConfig;
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Zou\Demo\Model\PhysicalStoreEvaluateFactory $physicalStoreEvaluateFactory,
        \Zou\Demo\Model\ResourceModel\PhysicalStoreEvaluate\CollectionFactory $physicalStoreEvaluateCollectionFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
        ) {
            parent::__construct($context);

            $this->_coreRegistry = $coreRegistry;
            $this->_resultPageFactory = $resultPageFactory;
            $this->_resultLayoutFactory = $resultLayoutFactory;
            $this->_resultForwardFactory = $resultForwardFactory;
    
            $this->_physicalStoreEvaluateFactory= $physicalStoreEvaluateFactory;
            $this->_physicalStoreEvaluateCollectionFactory = $physicalStoreEvaluateCollectionFactory;

    }
    
    /**
     * Get back result redirect after add/edit.
     *
     * @param \Magento\Framework\Controller\Result\Redirect $resultRedirect
     * @param null                                          $paramCrudId
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    protected function _getBackResultRedirect(\Magento\Framework\Controller\Result\Redirect $resultRedirect, $paramCrudId = null)
    {
        switch ($this->getRequest()->getParam('back')) {
            case 'edit':
                $resultRedirect->setPath(
                '*/*/edit',
                [
                static::PARAM_CRUD_ID => $paramCrudId,
                '_current' => true,
                ]
                );
                break;
            case 'new':
                $resultRedirect->setPath('*/*/new', ['_current' => true]);
                break;
            default:
                $resultRedirect->setPath('*/*/');
        }
    
        return $resultRedirect;
    }
    
    /**
     * Check if admin has permissions to visit related pages.
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Zou_Demo::physicalStores_physicalStoreEvaluate');
    }
}
