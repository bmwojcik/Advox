<?php

declare(strict_types=1);

namespace Advox\Order\Model\Queue\Request;

use Advox\Order\Api\Queue\OrderCommentRequestInterface;

class OrderComment implements OrderCommentRequestInterface
{
    private string $order;

    /**
     * @param string $order
     */
    public function __construct(string $order)
    {
        $this->order = $order;
    }

    /**  @inheritDoc */
    public function setOrder(string $order): OrderCommentRequestInterface
    {
        $this->order = $order;

        return $this;
    }

    /** @inheritDoc */
    public function getOrder(): string
    {
        return $this->order;
    }
}
