<?php
declare(strict_types=1);

namespace Advox\Order\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    public const ORDER_COMMENT_MESSAGE_XML_PATH = 'advox_order/comment/message';

    private ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param int|null $storeId
     *
     * @return string
     */
    public function getOrderCommentMessage(?int $storeId = null): string
    {
        return (string)$this->scopeConfig->getValue(
            self::ORDER_COMMENT_MESSAGE_XML_PATH,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
