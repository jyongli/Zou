<?php
namespace Zou\Demo\Block\Adminhtml\PhysicalStoreEvaluate\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
        parent::_construct();
        $this->setId('physicalstoreEval_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('PhysicalStoreEvaluate Information'));
    }
}
