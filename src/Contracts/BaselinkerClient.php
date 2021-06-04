<?php

namespace NetLinker\ApiBaselinker\Contracts;

use NetLinker\ApiBaselinker\Api\Request\Contracts\Order as OrderContract;
use NetLinker\ApiBaselinker\Api\Request\Contracts\Storage as StorageContract;
use NetLinker\ApiBaselinker\Config;

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
