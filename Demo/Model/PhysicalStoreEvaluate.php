<?php

/**
 * Zou
 *
 * NOTICE OF LICENSE
 *
 * DISCLAIMER
 *
 * 定义实体店员工表模型
 *
 * @category    Zou
 * @package     Zou_Demo
 * @copyright   Copyright (c) 2018 Zou
 */

namespace Zou\Demo\Model;
class PhysicalStoreEvaluate extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'physical_store_evaluate';

    protected $_cacheTag = 'physical_store_evaluate';

    protected $_eventPrefix = 'physical_store_evaluate';

    protected function _construct()
    {
        $this->_init('\Zou\Demo\Model\ResourceModel\PhysicalStoreEvaluate');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}