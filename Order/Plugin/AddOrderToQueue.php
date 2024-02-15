<?php

declare(strict_types=1);

namespace Advox\Order\Plugin;

use Advox\Order\Api\Queue\OrderCommentRequestInterfaceFactory;
use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Model\Service\OrderService;

class AddOrderToQueue
{
    private PublisherInterface $publisher;
    
    private OrderCommentRequestInterfaceFactory $orderCommentRequestFactory;

    /**
     * @param PublisherInterface $publisher
     * @param OrderCommentRequestInterfaceFactory $orderCommentRequestFactory
     */
    public function __construct(
        PublisherInterface $publisher,
        OrderCommentRequestInterfaceFactory $orderCommentRequestFactory
    )
    {
        $this->publisher = $publisher;
        $this->orderCommentRequestFactory = $orderCommentRequestFactory;
    }

    /**
     * @param OrderService $subject
     * @param OrderInterface $result
     * @param OrderInterface $order
     * @return OrderInterface
     */
    public function afterPlace(OrderService $subject, OrderInterface $result, OrderInterface $order): OrderInterface
    {
        if ($orderId = $order->getId()) {
            $this->publisher->publish(
                'advox.order.addComment',
                $this->orderCommentRequestFactory->create(
                    [
                        'order'  => $orderId,
                    ]
                )
            );
        }
        
        return $result;
    }
}
