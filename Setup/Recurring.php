<?php
/**
 * Copyright © Risecommerce (support@risecommerce.com). All rights reserved.
 *
 */
declare(strict_types=1);

namespace Risecommerce\XmlSitemap\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class Recurring implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $setup->startSetup();
        $connection = $setup->getConnection();

        foreach (['risecommerce_blog_post', 'risecommerce_blog_category'] as $tableName) {
            $tableName = $setup->getTable($tableName);

            if ($connection->isTableExists($tableName) == true && !$connection->tableColumnExists($tableName, 'rc_exclude_xml_sitemap')) {
                $columns = [
                    'rc_exclude_xml_sitemap' => [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                        'nullable' => false,
                        'comment' => 'Exclude From XML Sitemap',
                        'default' => '0'
                    ],
                ];

                foreach ($columns as $name => $definition) {
                    $connection->addColumn($tableName, $name, $definition);
                }
            }
        }

        $setup->endSetup();
    }
}