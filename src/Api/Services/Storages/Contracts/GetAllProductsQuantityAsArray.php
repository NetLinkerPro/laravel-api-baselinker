<?php

namespace NetLinker\ApiBaselinker\Api\Services\Storages\Contracts;
use NetLinker\ApiBaselinker\Api\Request\Contracts\Storage;
use NetLinker\ApiBaselinker\BaselinkerApiException;

interface GetAllProductsQuantityAsArray
{
    /**
     * Get all products quantity as array
     *
     * @param Storage $storageClient
     * @param array $parameters
     * @param array $options
     * @return array
     * @throws BaselinkerApiException
     */
    public function getAsArray(Storage $storageClient, array $parameters = [], array $options = []): array;
}
