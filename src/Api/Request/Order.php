<?php

namespace NetLinker\ApiBaselinker\Api\Request;

use NetLinker\ApiBaselinker\Api\Client;
use NetLinker\ApiBaselinker\Api\Response\Response;
use NetLinker\ApiBaselinker\Api\Request\Contracts\Order as OrderContract;
use NetLinker\ApiBaselinker\Api\Services\Orders\Contracts\GetAllFromDateOrdersAsArray;
use NetLinker\ApiBaselinker\BaselinkerApiException;

class Order extends Client implements OrderContract
{
    /**
     * Add order
     *
     * @param array $data
     * @return Response
     * @throws BaselinkerApiException
     */
    public function addOrder(array $data): Response
    {
        return new Response(
            $this->post('addOrder', $data)
        );
    }

    /**
     * Get orders
     *
     * @param array $data
     * @return Response
     * @throws BaselinkerApiException
     */
    public function getOrders(array $data): Response
    {
        return new Response(
            $this->post('getOrders', $data)
        );
    }

    /**
     * Get all from date orders as array
     *
     * @param array $parameters
     * @param array $options
     * @return array
     * @throws BaselinkerApiException
     */
    public function getAllFromDateOrdersAsArray(array $parameters = [], array $options = []): array{
        /** @var GetAllFromDateOrdersAsArray $service */
        $service = app(GetAllFromDateOrdersAsArray::class);
        return $service->getAsArray($this, $parameters, $options);
    }

    /**
     * Get order status list
     *
     * @return Response
     * @throws BaselinkerApiException
     */
    public function getOrderStatusList(): Response
    {
        return new Response(
            $this->post('getOrderStatusList')
        );
    }

    /**
     * Set order payment
     *
     * @param int $orderId
     * @param float $amount
     * @return Response
     * @throws BaselinkerApiException
     */
    public function setOrderPayment(int $orderId, float $amount): Response
    {
        return new Response(
            $this->post('setOrderPayment', [
                'order_id' => $orderId,
                'payment_done' => $amount,
            ])
        );
    }

    /**
     * Set order status
     *
     * @param int $orderId
     * @param int $statusId
     * @return Response
     * @throws BaselinkerApiException
     */
    public function setOrderStatus(int $orderId, int $statusId): Response
    {
        return new Response(
            $this->post('setOrderStatus', [
                'order_id' => $orderId,
                'status_id' => $statusId,
            ])
        );
    }
}
