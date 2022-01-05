<?php

namespace Zou\Dcyy\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;

class TestBlock extends \Magento\Theme\Block\Html\Title
{
    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        parent::__construct($context, $scopeConfig, $data);
    }

    public function getText()
    {
        return '到此一游3333';
    }
}
