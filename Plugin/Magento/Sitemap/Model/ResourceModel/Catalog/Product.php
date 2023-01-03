<?php
/**
 * Copyright © Risecommerce (support@risecommerce.com). All rights reserved.
 *
 */
declare(strict_types=1);

namespace Risecommerce\XmlSitemap\Plugin\Magento\Sitemap\Model\ResourceModel\Catalog;

use Magento\Sitemap\Model\ResourceModel\Catalog\Product as Subject;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Risecommerce\XmlSitemap\Model\Config;

class Product
{
    /**
     * @var ProductCollectionFactory
     */
    private $productCollectionFactory;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @param ProductCollectionFactory $productCollectionFactory
     * @param Config $config
     */
    public function __construct(
        ProductCollectionFactory $productCollectionFactory,
        Config $config
    )
    {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->config = $config;
    }

    /**
     * @param Subject $subject
     * @param array $result
     * @return array
     */
    public function afterGetCollection(Subject $subject,array $result): array {

        if ($result && $this->config->isEnabled()) {
            $productCollection = $this->productCollectionFactory->create()
                ->addFieldToFilter('rc_exclude_xml_sitemap',['eq' => 1]);

            if ($productCollection) {
                $excludedIds = array_flip($productCollection->getAllIds());

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