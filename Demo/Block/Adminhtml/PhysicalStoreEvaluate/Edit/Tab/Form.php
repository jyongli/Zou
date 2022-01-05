<?php
namespace Zou\Demo\Block\Adminhtml\PhysicalStoreEvaluate\Edit\Tab;

use Zou\Demo\Model\Status;

class Form extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface {

    const FIELD_NAME_SUFFIX = 'physicalStoreEvaluate';

    protected $_fieldFactory;
    protected $_physicalStoresHelper;
    protected $_systemStore;
    protected $_scopeConfig;
    protected $_wysiwygConfig;
    public function __construct(
        \Magento\Backend\Block\Template\Context $context, 
        \Zou\Demo\Helper\Data $physicalStoresHelper, 
        \Magento\Framework\Registry $registry, 
        \Magento\Framework\Data\FormFactory $formFactory, 
        \Magento\Config\Model\Config\Structure\Element\Dependency\FieldFactory $fieldFactory, 
        \Magento\Store\Model\System\Store $systemStore, 
         \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        array $data = []
    ) {
        $this->_physicalStoresHelper = $physicalStoresHelper;
        $this->_systemStore = $systemStore;
        $this->_fieldFactory = $fieldFactory;
        $this->_scopeConfig = $context->getScopeConfig();
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareLayout() {
        $this->getLayout()->getBlock('page.title')->setPageTitle($this->getPageTitle());
    }
    
    protected function _prepareForm() {

        $physicalStoreEval = $this->getPhysicalStoreEvaluate();
        $isElementDisabled = true;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        /*
         * declare dependence
         */
        // dependence block
        $dependenceBlock = $this->getLayout()->createBlock(
            'Magento\Backend\Block\Widget\Form\Element\Dependence'
        );

        // dependence field map array
        $fieldMaps = [];

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('PhysicalStoreEvaluate Information')]);
        if ($physicalStoreEval->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

        $fieldset->addField(
            'evaluate_content', 'text', [
            'name' => 'evaluate_content',
            'label' => __('evcontent'),
            'title' => __('eval_content'),
            'required' => true,
            'class' => 'required-entry',
            ]
        );


        $fieldset->addField(
            'mage_store_ids', 'multiselect', [
            'name' => 'mage_store_ids',
            'label' => __('Store View'),
            'title' => __('Store View'),
            'required' => true,
            'values' => $this->_systemStore->getStoreValuesForForm(false, true),
            'class' => 'required-entry',
            ]
        );
        $fieldset->addField(
            'auditResult', 'select', [
            'name' => 'auditResult',
            'label' => __('aResult'),
            'title' => __('aResult'),
            'required' => true,
            'values' => Status::getAvailableStatuses(),
            'class' => 'required-entry'
            ]
        );
        $form->setValues($physicalStoreEval->getData());
        // $form->addFieldNameSuffix(self::FIELD_NAME_SUFFIX);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    public function getWebsites() {
        $stores = array();
        $store = $this->_physicalStoresHelper->getAllStores();
        foreach ($store as $k => $v) {
            $stores[$k]['value'] = $v->getWebsiteId();
            $stores[$k]['label'] = $v->getName();
        }
        array_unshift($stores, ['value' => '', 'label' => __('All Store Views')]);
        return $stores;
    }

    public function getPhysicalStoreEvaluate() {
        return $this->_coreRegistry->registry('physicalStoreEvaluate');
    }

    public function getPageTitle() {
        return $this->getPhysicalStoreEvaluate()->getId() ? __("Edit PhysicalStoreEvaluate ") : __('New PhysicalStoreEvaluate');
    }

    /**
     * Prepare label for tab.
     *
     * @return string
     */
    public function getTabLabel() {
        return __('PhysicalStoreEvaluate  Information');
    }

    /**
     * Prepare title for tab.
     *
     * @return string
     */
    public function getTabTitle() {
        return __('PhysicalStoreEvaluate  Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab() {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden() {
        return false;
    }

}
