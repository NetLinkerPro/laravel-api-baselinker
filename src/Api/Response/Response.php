<?php

namespace NetLinker\LaravelApiBaselinker\Api\Response;

use NetLinker\LaravelApiBaselinker\BaselinkerApiException;
use Psr\Http\Message\ResponseInterface;

class Response
{
    /** @var ResponseInterface $response */
    private $response;

   /** @var string $contents */
    private $contents;

   /** @var array $array */
    private $array;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        if ($this->hasError()) {
            $data = $this->toArray();
            if ($data['error_code'] === 'ERROR_BAD_PRODUCTS'){
                $userMessage =  _p('baselinker-client::exceptions.client.product_is_not_in_storage', 'The product is not in Baselinker storage.');
                throw new BaselinkerApiException(sprintf('[%s]: %s', $data['error_code'], $data['error_message']));
            } else {
                throw new BaselinkerApiException(sprintf('[%s]: %s', $data['error_code'], $data['error_message']));
            }

        }
    }

    /**
     * Return the response's body as a `string`.
     *
     * @return string
     */
    public function contents(): string
    {
        if (!$this->contents) {
            $this->contents = $this->response->getBody()->getContents();
        }
        return $this->contents;
    }

    /**
     * Return the response as an `array`.
     *
     * @return array
     */
    public function toArray(): array
    {
        if (!$this->array) {
            $this->array = json_decode($this->contents(), true, 512, JSON_UNESCAPED_UNICODE);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->array = [];
            }
        }
        return $this->array;
    }

    /**
     * Return the provided parameter's value from the response's JSON.
     *
     * @param string $parameter
     * @return mixed
     */
    public function getParameter(string $parameter)
    {
        return $this->toArray()[$parameter];
    }

    /**
     * Return `true` if response status isn't "success".
     *
     * @return bool
     */
    private function hasError(): bool
    {
        $status = $this->getParameter('status');
        return strtolower($status) !== 'success';
    }
}
