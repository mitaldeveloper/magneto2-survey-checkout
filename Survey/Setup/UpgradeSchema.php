<?php
namespace Mital\Survey\Setup;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $quoteTable = 'quote';
        $orderTable = 'sales_order';
        //Quote table   
        if(version_compare($context->getVersion(), '2.0.1', '<')) {
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteTable),
                'survey_question',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => '255',                    
                    'nullable' => true,
                    'comment' => 'Survey Title or question'
                ]
            );
        //Order table
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($orderTable),
                'survey_question',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => '255',                    
                    'nullable' => true,
                    'comment' => 'Survey Title or question'
                ]
            );
        //Quote table 
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteTable),
                'survey_answer',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => '255',                    
                    'nullable' => true,
                    'comment' => 'Survey answer'
                ]
            );
        //Order table
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($orderTable),
                'survey_answer',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => '255',                    
                    'nullable' => true,
                    'comment' => 'Survey answer'
                ]
            );

        }        

        $setup->endSetup();
    }
}