<?php
namespace Zou\Demo\Block\Adminhtml\PhysicalStoreEvaluate;
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry.
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @param Context $context
     * @param array   $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'Zou_Demo';
        $this->_controller = 'adminhtml_physicalStoreEvaluate';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save PhysicalStoreEvaluate'));
        $this->buttonList->update('delete', 'label', __('Delete'));

        $this->buttonList->add(
            'save_and_continue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                    ],
                ],
            ],
            10
        );

        
    }

    public function getPhysicalStoreEvaluate()
    {
        return $this->_coreRegistry->registry('physicalStoreEvaluate');
    }

    /**
     * Retrieve the save and continue edit Url.
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl(
            '*/*/save',
            ['_current' => true, 'back' => 'edit', 'tab' => '{{tab_id}}']
        );
    }

}
