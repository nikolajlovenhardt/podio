<?php

namespace nlp\Podio\Services;

use nlp\Podio\Options\PodioOptions;
use nlp\Podio\Podio;

class ApiService implements ApiServiceInterface
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    /** @var Podio */
    protected $podio;

    /** @var PodioOptions */
    protected $options;

    /** @var CurlService */
    protected $curlService;

    public function __construct(Podio $podio, PodioOptions $options)
    {
        $this->podio = $podio;
        $this->options = $options;
        $this->curlService = new CurlService($options);
    }

    /**
     * GET
     *
     * @param string $url
     * @param array $attributes
     * @param array $options
     */
    public function get($url, array $attributes = [], array $options = [])
    {
        return $this->request(self::GET, $url, $attributes, $options);
    }

    /**
     * POST
     *
     * @param string $url
     * @param array $attributes
     * @param array $options
     */
    public function post($url, array $attributes = [], array $options = [])
    {
        return $this->request(self::POST, $url, $attributes, $options);
    }

    /**
     * PUT
     *
     * @param string $url
     * @param array $attributes
     * @param array $options
     */
    public function put($url, array $attributes = [])
    {
        return $this->request(self::PUT, $url, $attributes);
    }

    /**
     * DELETE
     *
     * @param string $url
     * @param array $attributes
     * @param array $options
     */
    public function delete($url, array $attributes = [])
    {
        return $this->request(self::DELETE, $url, $attributes);
    }

    /**
     * Call API
     *
     * @param string $method
     * @param string $url
     * @param array $attributes
     * @param array $options
     */
    public function request($method, $url, array $attributes = [], array $options = [])
    {
        // Add client ID & secret
        $credentials = $this->podio->getCredentials();

        $attributes = array_merge(
            $credentials,
            $attributes
        );

        return $this->curlService->curl(
            $method,
            $url,
            $attributes,
            $options
        );
    }

    /**
     * @return PodioOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param PodioOptions $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }
}
