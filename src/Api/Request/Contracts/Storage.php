<?php

namespace NetLinker\ApiBaselinker\Api\Request\Contracts;

use NetLinker\ApiBaselinker\Api\Response\Response;
use NetLinker\ApiBaselinker\BaselinkerApiException;

interface Storage
{
    /**
     * Get storages list
     *
     * @return Response
     * @throws BaselinkerApiException
     */
    public function getStoragesList(): Response;

    /**
     * Get storages list from cache
     *
     * @return Response
     * @throws BaselinkerApiException
     */
    public function getStoragesListFromCache();

    /**
     * Get products data
     *
     * @param array $data
     * @return Response
     * @throws BaselinkerApiException
     */
    public function getProductsData(array $data): Response;

    /**
     * Update products prices
     *
     * @param array $data
     * @return Response
     * @throws BaselinkerApiException
     */
    public function updateProductsPrices(array $data): Response;

    /**
     * Get products quantity
     *
     * @param array $data
     * @return Response
     * @throws BaselinkerApiException
     */
    public function getProductsQuantity(array $data): Response;

    /**
     * Get all products quantity as array
     *
     * @param array $parameters
     * @param array $options
     * @return array
     * @throws BaselinkerApiException
     */
    public function getAllProductsQuantityAsArray(array $parameters = [], array $options = []): array;
}
