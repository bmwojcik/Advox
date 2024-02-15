<?php

declare(strict_types=1);

namespace Advox\Order\Model\Queue;

use Advox\Order\Api\Queue\OrderCommentRequestInterface;
use Advox\Order\Model\Config;
use Error;
use Magento\Sales\Api\OrderRepositoryInterface;
use Monolog\Logger;

class MessageProcessor
{
    private OrderRepositoryInterface $orderRepository;

    private Config $config;

    private Logger $logger;

    /**
     * @param OrderRepositoryInterface $orderRepository
     * @param Config $config
     * @param Logger $logger
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        Config $config,
        Logger $logger
    )
    {
        $this->orderRepository = $orderRepository;
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * @param OrderCommentRequestInterface $request
     *
     * @return bool
     */
    public function addOrderComment(OrderCommentRequestInterface $request): bool
    {
        try {
            $order = $this->orderRepository->get((int) $request->getOrder());

            if ($comment = $this->config->getOrderCommentMessage((int) $order->getStoreId())) {
                $order->addCommentToStatusHistory($comment);
                $this->orderRepository->save($order);
            }

            return true;
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());

            throw new Error($exception->getMessage());
        }
    }
}
