<?php

declare(strict_types=1);

namespace Advox\Order\Api\Queue;

interface OrderCommentRequestInterface
{
    /**
     * @param string $order
     *
     * @return self
     */
    public function setOrder(string $order): self;

    /**
     * @return string
     */
    public function getOrder(): string;
}
