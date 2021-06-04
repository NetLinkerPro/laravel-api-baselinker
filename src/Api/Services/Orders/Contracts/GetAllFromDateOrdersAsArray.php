<?php

namespace NetLinker\LaravelApiBaselinker\Api\Services\Orders\Contracts;
use NetLinker\LaravelApiBaselinker\Api\Request\Contracts\Order;
use NetLinker\LaravelApiBaselinker\BaselinkerApiException;

interface GetAllFromDateOrdersAsArray
{
    /**
     * Get all from date orders as array
     *
     * @param Order $orderClient
     * @param array $parameters
     * @param array $options
     * @return array
     * @throws BaselinkerApiException
     */
    public function getAsArray(Order $orderClient, array $parameters = [], array $options = []): array;
}
