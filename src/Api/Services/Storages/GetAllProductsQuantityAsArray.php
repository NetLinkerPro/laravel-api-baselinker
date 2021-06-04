<?php

namespace NetLinker\LaravelApiBaselinker\Api\Services\Storages;
use NetLinker\LaravelApiBaselinker\Api\Request\Contracts\Storage;
use NetLinker\LaravelApiBaselinker\Api\Services\Storages\Contracts\GetAllProductsQuantityAsArray as GetAllProductsQuantityAsArrayContract;
use NetLinker\LaravelApiBaselinker\BaselinkerApiException;

class GetAllProductsQuantityAsArray implements GetAllProductsQuantityAsArrayContract
{
    /** @var Storage $storageClient */
    private $storageClient;

    /** @var array $parameters */
    private $parameters;

    /** @var array $options */
    private $options;

    /**
     * Get all products quantity as array
     *
     * @param Storage $storageClient
     * @param array $parameters
     * @param array $options
     * @return array
     * @throws BaselinkerApiException
     */
    public function getAsArray(Storage $storageClient, array $parameters = [], array $options = []): array{
        $this->setStorageClient($storageClient);
        $this->setParameters($parameters);
        $this->setOptions($options);
        $productQuantities = [];
        for ($page = 1; $page < 1000 ; $page++){
            $pageQuantities = $this->getPageQuantities($page);
            if (!$pageQuantities){
                break;
            }
            $productQuantities = array_merge($productQuantities, $pageQuantities);
            sleep(4);
        }
        return $productQuantities;
    }

    /**
     * Set storage client
     * @param Storage $storageClient
     * @return $this
     */
    private function setStorageClient(Storage $storageClient)
    {
        $this->storageClient = $storageClient;
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
     * Get page quantities
     *
     * @param int $page
     * @return array|mixed
     * @throws BaselinkerApiException
     */
    private function getPageQuantities(int $page)
    {
        $parameters = $this->parameters;
        $parameters['page']= $page;
        $this->storageClient->getProductsQuantity($parameters)->toArray();
        return $response['products'] ?? [];
    }
}
