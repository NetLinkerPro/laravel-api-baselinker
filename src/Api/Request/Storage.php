<?php

namespace NetLinker\LaravelApiBaselinker\Api\Request;

use Illuminate\Support\Facades\Config;
use NetLinker\LaravelApiBaselinker\Api\Client;
use NetLinker\LaravelApiBaselinker\Api\Response\Response;
use NetLinker\LaravelApiBaselinker\Api\Request\Contracts\Storage as StorageContract;
use NetLinker\LaravelApiBaselinker\Api\Services\Storages\Contracts\GetAllProductsQuantityAsArray;
use NetLinker\LaravelApiBaselinker\BaselinkerApiException;
use Illuminate\Support\Facades\Cache;

class Storage extends Client implements StorageContract
{
    /**
     * Get storages list
     *
     * @return Response
     * @throws BaselinkerApiException
     */
    public function getStoragesList(): Response
    {
        return new Response(
            $this->post('getStoragesList')
        );
    }

    /**
     * Get storages list from cache
     *
     * @return Response
     * @throws BaselinkerApiException
     */
    public function getStoragesListFromCache(){
        $cacheKey = sprintf('baselinker-client.client.storage.getStoragesList.%s', $this->config->getToken());
        $response = Cache::get($cacheKey);
        if (!$response){
            /** @var Response $response */
            $response = $this->getStoragesList();
            Cache::put($cacheKey, $response, Config::get('baselinker-client.cache_baselinker_client_storages_ttl'));
        }
        return $response;
    }

    /**
     * Get products data
     *
     * @param array $data
     * @return Response
     * @throws BaselinkerApiException
     */
    public function getProductsData(array $data): Response
    {
        return new Response(
            $this->post('getProductsData', $data)
        );
    }

    /**
     * Get products list
     *
     * @param array $data
     * @return Response
     * @throws BaselinkerApiException
     */
    public function getProductsList(array $data): Response
    {
        return new Response(
            $this->post('getProductsList', $data)
        );
    }

    /**
     * Update products prices
     *
     * @param array $data
     * @return Response
     * @throws BaselinkerApiException
     */
    public function updateProductsPrices(array $data): Response
    {
        return new Response(
            $this->post('updateProductsPrices', $data)
        );
    }

    /**
     * Get products quantity
     *
     * @param array $data
     * @return Response
     * @throws BaselinkerApiException
     */
    public function getProductsQuantity(array $data): Response
    {
        return new Response(
            $this->post('getProductsQuantity', $data)
        );
    }

    /**
     * Get all products quantity as array
     *
     * @param array $parameters
     * @param array $options
     * @return array
     * @throws BaselinkerApiException
     */
    public function getAllProductsQuantityAsArray(array $parameters = [], array $options = []): array{
        /** @var GetAllProductsQuantityAsArray $service */
        $service = app(GetAllProductsQuantityAsArray::class);
        return $service->getAsArray($this, $parameters, $options);
    }
}
