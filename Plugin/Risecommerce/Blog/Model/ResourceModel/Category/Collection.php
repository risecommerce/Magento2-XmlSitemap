<?php
/**
 * Copyright © Risecommerce (support@risecommerce.com). All rights reserved.
 *
 */
declare(strict_types=1);

namespace Risecommerce\XmlSitemap\Plugin\Risecommerce\Blog\Model\ResourceModel\Category;

use Risecommerce\XmlSitemap\Model\Config;

class Collection
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @param Config $config
     */
    public function __construct(
        Config $config
    )
    {
        $this->config = $config;
    }

    public function beforeLoad($subject,$printQuery = false, $logQuery = false) {
        if ($this->config->isEnabled()) {
            $backTrace = \Magento\Framework\Debug::backtrace(true, true, false);

            if (false !== strpos($backTrace, 'Magento\Sitemap\Model\Sitemap')) {
                $subject->addFieldToFilter('rc_exclude_xml_sitemap', ['neq' => 1]);
            }
        }
    }
}