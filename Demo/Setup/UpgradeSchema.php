<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Zou\Demo\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;


/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '0.1.1', '<')) {
            /*
            $this->addNewField($setup, "physical_stores", "website", array(
                "type" => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                "nullable" => true,
                "length" => 255,
                "comment" => "Physical store's website URL",
                "after" => "email"
            ));
            */
        }

        if (version_compare($context->getVersion(), '0.1.2', '<')){
            $this->addNewTableEvaluate($setup);
        }

        if(version_compare($context->getVersion(), '0.1.3', '<')){
            $this->addNewColEvaluate($setup);
        }
    }
    /*
    protected function changeMageWebisteIdToText($setup){
        $setup->startSetup();
        $setup->getConnection()->changeColumn(
            $setup->getTable("physical_stores"),
            "mage_website_id",
            "mage_store_ids",
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => true,
                'length' => 255,
                'comment' => 'Magento Store Ids'
            ]
        );
        $setup->endSetup();
    }
    */
    protected function addNewField($setup, $table, $newField, $options){
        $setup->startSetup();
        $setup->getConnection()->addColumn(
            $setup->getTable($table),
            $newField,
            $options
        );
        $setup->endSetup();
    }


    protected function addNewColEvaluate($setup){
        $this->addNewField($setup, "physical_store_evaluate", "auditResult", array(
            "type" => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            "nullable" => true,
            "default" => '0',
            "comment" => "该店铺评论是否通过审核"
        ));
    }

    protected function addNewTableEvaluate($setup){
        $installer = $setup;

        $installer->startSetup();
        $table = $installer->getConnection()->newTable($installer->getTable('physical_store_evaluate'))
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'ID'
            )
            ->addColumn(
                'evaluate_content',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '255',
                [],
                'content'
            )
            ->addColumn(
                'store_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => true],
                'physical_stores table ID'
            )
            ->addForeignKey(
                $installer->getFkName('physical_store_evaluate', 'store_id', 'physical_stores', 'id'),
                'store_id',
                $installer->getTable('physical_stores'),
                'id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );
        ;
        $installer->getConnection()->createTable($table);
        $setup->endSetup();
    }
}
