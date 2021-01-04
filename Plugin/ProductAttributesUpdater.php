<?php


namespace Inchoo\PluginSample\Plugin;


use Psr\Log\LoggerInterface;

class ProductAttributesUpdater
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function beforeSetName(\Magento\Catalog\Model\Product $subject, $name)
    {
        return ['(' . $name . ')'];
    }

    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        return '|' . $result . '|';
    }

    public function aroundGetName(\Magento\Catalog\Model\Product $subject, callable $proceed)
    {
        $this->logger->info('Around before getName');
        $result = $proceed();
        $this->logger->info('Around after getName');
        return $result;
    }
}
