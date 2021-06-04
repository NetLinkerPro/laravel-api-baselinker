<?php

namespace NetLinker\ApiBaselinker\Api;

use NetLinker\ApiBaselinker\Config;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class Client
{
    const URL_LIVE = 'https://api.baselinker.com/';

   /** @var Config $config */
    protected $config;

   /** @var GuzzleClient $client */
    private $client;


    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Post
     *
     * @param string $function
     * @param array $parameters
     * @return ResponseInterface
     */
    protected function post(string $function, array $parameters = []): ResponseInterface
    {
        return $this->client()->post('connector.php', [
            'form_params' => [
                'token' => $this->config->getToken(),
                'method' => $function,
                'parameters' => json_encode($parameters, JSON_UNESCAPED_UNICODE),
            ],
        ]);
    }

    /**
     * Client
     *
     * @return ClientInterface
     */
    protected function client(): ClientInterface
    {
        if (!$this->client) {
            $this->client = new GuzzleClient([
                'base_uri' => $this->getApiUrl(),
            ]);
        }

        return $this->client;
    }

    /**
     * Get API url
     * @return string
     */
    private function getApiUrl(): string
    {
        return self::URL_LIVE;
    }
}
