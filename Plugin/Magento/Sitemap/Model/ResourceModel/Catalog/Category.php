<?php
/**
 * Copyright © Risecommerce (support@risecommerce.com). All rights reserved.
 *
 */
declare(strict_types=1);

namespace Risecommerce\XmlSitemap\Plugin\Magento\Sitemap\Model\ResourceModel\Catalog;

use Magento\Sitemap\Model\ResourceModel\Catalog\Category as Subject;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Risecommerce\XmlSitemap\Model\Config;

class Category
{
    /**
     * @var CategoryCollectionFactory
     */
    private $categoryCollectionFactory;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @param CategoryCollectionFactory $categoryCollectionFactory
     * @param Config $config
     */
    public function __construct(
        CategoryCollectionFactory $categoryCollectionFactory,
        Config $config
    )
    {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->config = $config;
    }

    /**
     * @param Subject $subject
     * @param array $result
     * @return array
     */
    public function afterGetCollection(Subject $subject,array $result): array {

        if ($result && $this->config->isEnabled()) {
            $categoryCollection = $this->categoryCollectionFactory->create()
                ->addFieldToFilter('rc_exclude_xml_sitemap',['eq' => 1]);

            if ($categoryCollection) {
                $excludedIds = array_flip($categoryCollection->getAllIds());

                foreach ($result as $key => $item) {
                    if (isset($excludedIds[(int)$item->getId()])) {
                        unset($result[(int)$key]);
                    }
                }
            }
        }

        return $result;
    }
}