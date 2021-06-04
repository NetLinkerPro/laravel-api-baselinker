<?php

namespace NetLinker\ApiBaselinker;

use InvalidArgumentException;

class Config
{
    /** @var string $token */
    private $token;

    public function __construct(array $parameters)
    {
        $this->set($parameters);
    }

    /**
     * Set
     *
     * @param array $parameters
     * @return $this
     */
    public function set(array $parameters): self
    {
        if (!$parameters['token']) {
            throw new InvalidArgumentException('Parameter "token" must be provided in the configuration.');
        }
        $this->token = $parameters['token'];
        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}
