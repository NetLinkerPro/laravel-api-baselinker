<?php

namespace NetLinker\ApiBaselinker\Api\Request\Contracts;

use NetLinker\ApiBaselinker\Api\Response\Response;
use NetLinker\ApiBaselinker\BaselinkerApiException;

interface Order
{
    /**
     * Add order
     *
     * @param array $data
     * @return Response
     * @throws BaselinkerApiException
     */
    public function addOrder(array $data): Response;

    /**
     * Get orders
     *
     * @param array $data
     * @return Response
     * @throws BaselinkerApiException
     */
    public function getOrders(array $data): Response;

    /**
     * Get all from date orders as array
     *
     * @param array $parameters
     * @param array $options
     * @return array
     * @throws BaselinkerApiException
     */
    public function getAllFromDateOrdersAsArray(array $parameters = [], array $options = []): array;

    /**
     * Get order status list
     *
     * @return Response
     * @throws BaselinkerApiException
     */
    public function getOrderStatusList(): Response;

    /**
     * Set order payment
     *
     * @param int $orderId
     * @param float $amount
     * @return Response
     * @throws BaselinkerApiException
     */
    public function setOrderPayment(int $orderId, float $amount): Response;

    /**
     * Set order status
     *
     * @param int $orderId
     * @param int $statusId
     * @return Response
     * @throws BaselinkerApiException
     */
    public function setOrderStatus(int $orderId, int $statusId): Response;
}
