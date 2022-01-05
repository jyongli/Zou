<?php
namespace Zou\Demo\Controller\Physicalstore;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class newev extends Action
{

    private $resultJsonFactory;
    protected $_PhysicalStoreEvaluateFactory;
    protected $_dbConnection;
    protected $_StoreEvaluateCollectionFactory;

    public function __construct(JsonFactory $resultJsonFactory, Context $context
        ,   \Zou\Demo\Model\PhysicalStoreEvaluateFactory $PhysicalStoreEvaluateFactory
    ,\Magento\Framework\App\ResourceConnection $ResourceConnection,
      \Zou\Demo\Model\ResourceModel\PhysicalStoreEvaluate\CollectionFactory     $StoreEvaluateCollectionFactory
    )
    {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_PhysicalStoreEvaluateFactory = $PhysicalStoreEvaluateFactory;
        $this->_StoreEvaluateCollectionFactory = $StoreEvaluateCollectionFactory;
        $this->_dbConnection = $ResourceConnection->getConnection();
    }

    public function execute()
    {
        try{
            $resultJson = $this->resultJsonFactory->create();
            $this->_dbConnection->beginTransaction();

           /**** model  model  model  model add */
            $model = $this->_PhysicalStoreEvaluateFactory->create();
            $model->setData(['evaluate_content' =>$_POST['EvaluateContent'],'store_id'=>$_POST['storeId']]);
            $ret = $model->save()->getData(); //返回成功后的那条记录,注意：长度过长时，会自动截断保存？？！！！！！！！
            if(isset($ret['id'] )&& $ret['id'] >1){
                //操作成功
            }else{
                //操作失败，ROLLBACK
                $this->_dbConnection->rollBack();
                return $resultJson->setData(['result' => false,'msg'=>'err msg XXX']);
            }

           /**** model  model  model  model  update */
           /* $model = $this->_PhysicalStoreEvaluateFactory->create();
            $postUpdate = $model->load('7');
            $postUpdate->setEvaluateContent('成功后的那条记录');
            $postUpdate->save();
            */


            /**** model  model  model  model  delete*/
            /*$model = $this->_PhysicalStoreEvaluateFactory->create();
            $model->load('7')->delete();
            */


            /**** model  model  model  model   Read*/
            /*$model = $this->_PhysicalStoreEvaluateFactory->create();
            $model->load('4');
            $data = $model->getData();*/


            /**** collection   collection   collection   join */
           /* $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
            $collection = $objectManager->get('Zou\Demo\Model\PhysicalStoreEvaluate')->getCollection(); //main_table
            $collection->getSelect()
                ->joinLeft('physical_stores' , 'physical_stores.id = main_table.store_id', array('name'))
                ->joinLeft('physical_store_staff' , 'physical_store_staff.store_id = physical_stores.id', array('firstname','lastname'));
            $ret=$collection->getData();
            echo $collection->getSelect()->__toString();//print RAW SQL
            var_dump($ret);exit;
            */



        /////////////////////////////////  Raw sql /////////////////////////////////////////////////////////


            /****delete*/
            /*$sql = "Delete FROM  physical_store_evaluate  Where id in( 10,11,9)";
            $ret = $this->_dbConnection->query($sql)->rowCount();
            var_dump($ret);exit;*/

            /****add***/
            /*$sql = "INSERT INTO `physical_store_evaluate` (`evaluate_content`, `store_id`) VALUES ('231123', '1')";
            $ret = $this->_dbConnection->query($sql);
            var_dump($this->_dbConnection->lastInsertId());exit;
            */

            /****SELECT */
            /*
            $sql = "Select * FROM physical_store_evaluate" ;
            $result1 =  $this->_dbConnection->fetchRow($sql); //get one info
            $result2 =  $this->_dbConnection->fetchAll($sql);   //get all info
            */


            $this->_dbConnection->commit();
            return $resultJson->setData(['result' => true,'msg'=>'add  success']);
        } catch (\Exception $e) {
            // Rollback transaction
            return $resultJson->setData(['result' => false,'msg'=>'add  failed','errTraceMsg'=>$e->getTraceAsString(),'errMsg'=>$e->getMessage()]);
            $this->_dbConnection->rollBack();
        }


    }
}