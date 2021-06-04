<?php

namespace NetLinker\ApiBaselinker\Api\Services\Orders;
use NetLinker\ApiBaselinker\Api\Request\Contracts\Order;
use NetLinker\ApiBaselinker\Api\Services\Orders\Contracts\GetAllFromDateOrdersAsArray as GetAllFromDateOrdersAsArrayContract;
use NetLinker\ApiBaselinker\BaselinkerApiException;

class GetAllFromDateOrdersAsArray implements GetAllFromDateOrdersAsArrayContract
{
    /** @var Order $orderClient */
    private $orderClient;

    /** @var array $parameters */
    private $parameters;

    /** @var array $options */
    private $options;

    /**
     * Get all from date orders as array
     *
     * @param Order $orderClient
     * @param array $parameters
     * @param array $options
     * @return array
     */
    public function getAsArray(Order $orderClient, array $parameters = [], array $options = []): array{
        $this->setOrderClient($orderClient);
        $this->setParameters($parameters);
        $this->setOptions($options);
        $dateFrom = $this->getDateFrom();
        $orders = [];
        while ($partOrders = $this->getPartOrders($dateFrom)) {
            $sizePartOrders = sizeof($partOrders);
            $orders = array_merge($orders, $partOrders);
            if ($sizePartOrders < 100){
                break;
            }
            $dateFrom = $this->getDateFromByOrder(end($partOrders));
        }
        return $orders;
    }

    /**
     * Set order client
     * @param Order $orderClient
     * @return $this
     */
    private function setOrderClient(Order $orderClient)
    {
        $this->orderClient = $orderClient;
        return $this;
    }

    /**
     * Set parameters
     *
     * @param array $parameters
     * @return $this
     */
    private function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }

    /**
     * Set options
     *
     * @param array $options
     * @return $this
     */
    private function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Get part orders
     *
     * @param $dateFrom
     * @return array
     * @throws BaselinkerApiException
     */
    private function getPartOrders($dateFrom)
    {
        $parameters = $this->parameters;
        if ($this->parameters['data_from'] ?? false){
            $parameters['date_from']=$dateFrom;
        } else {
            $parameters['date_confirmed_from'] = $dateFrom;
        }
        $response = $this->orderClient->getOrders($parameters)->toArray();
        return $response['orders'] ?? [];
    }

    /**
     * Get date from
     *
     * @return mixed
     */
    private function getDateFrom()
    {
        return $this->parameters['data_from'] ?? $this->parameters['date_confirmed_from'];
    }

    /**
     * Get date from by order
     *
     * @param $order
     * @return mixed
     */
    private function getDateFromByOrder($order)
    {
        if ($this->parameters['data_from'] ?? false){
            return $order['date_add'];
        } else {
            return $order['date_confirmed'];
        }
    }
}
