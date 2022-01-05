<?php
namespace Zou\Demo\Block\Physicalstore;

class Evaluate extends \Magento\Framework\View\Element\Template
{

    protected $_model_physicalStore_evaluate =null;
    protected $product=null;

    public function __construct(
        \Zou\Demo\Model\PhysicalStoreEvaluate $PhysicalStoreEvaluate,
        \Magento\Framework\View\Element\Template\Context $context,
      array $data = []
    )
    {
        $this->_model_physicalStore_evaluate=$PhysicalStoreEvaluate;
        parent::__construct($context, $data);
    }


    public function getEvaluate(){

        $pyStoreEval = $this->_model_physicalStore_evaluate->getCollection()
            ->addFieldToFilter("store_id", $this->product)->addFieldToFilter("auditResult", '1')->getData();
        return $pyStoreEval;
    }

    public function setProduct($product)
    {
        $this-> product= $product;
    }

    public function getStoreId(){
        return $this->product;
    }


}