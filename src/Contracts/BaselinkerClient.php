<?php

namespace NetLinker\LaravelApiBaselinker\Contracts;

use NetLinker\LaravelApiBaselinker\Api\Request\Contracts\Order as OrderContract;
use NetLinker\LaravelApiBaselinker\Api\Request\Contracts\Storage as StorageContract;
use NetLinker\LaravelApiBaselinker\Config;

interface BaselinkerClient
{
    /**
     * Orders
     *
     * @return OrderContract
     */
    public function orders(): OrderContract;

    /**
     * Storages
     *
     * @return StorageContract
     */
    public function storages(): StorageContract;

    /**
     * Get config
     *
     * @return Config
     */
    public function getConfig(): Config;
}
