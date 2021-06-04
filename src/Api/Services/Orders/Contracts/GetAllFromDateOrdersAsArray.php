<?php

namespace NetLinker\ApiBaselinker\Api\Services\Orders\Contracts;
use NetLinker\ApiBaselinker\Api\Request\Contracts\Order;
use NetLinker\ApiBaselinker\BaselinkerApiException;

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
