<?php
namespace Zou\Demo\Block\Adminhtml;

class PhysicalStoreEvaluate extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor.
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_physicalStoreEvaluate';
        $this->_blockGroup = 'Zou_Demo';
        $this->_headerText = __('PhysicalStoreEvaluate');
        $this->_addButtonLabel = __('Add New Evaluate');
        parent::_construct();
    }
}
