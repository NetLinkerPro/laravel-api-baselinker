<?php

namespace NetLinker\ApiBaselinker;

use NetLinker\ApiBaselinker\Api\Request\Contracts\Order as OrderContract;
use NetLinker\ApiBaselinker\Api\Request\Contracts\Storage as StorageContract;
use NetLinker\ApiBaselinker\Api\Request\Order;
use NetLinker\ApiBaselinker\Api\Request\Storage;
use NetLinker\ApiBaselinker\Contracts\BaselinkerClient as BaselinkerClientContract;

class BaselinkerClient implements BaselinkerClientContract
{
    /** @var Config $config */
    private $config;

    public function __construct(array $parameters)
    {
        $this->config = new Config($parameters);
    }

    /**
     * Orders
     *
     * @return OrderContract
     */
    public function orders(): OrderContract
    {
        return new Order($this->config);
    }

    /**
     * Storages
     *
     * @return StorageContract
     */
    public function storages(): StorageContract
    {
        return new Storage($this->config);
    }


    /**
     * Get config
     *
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

}
