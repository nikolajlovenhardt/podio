<?php

namespace nlp\Podio\Services;

use nlp\Podio\Options\PodioOptions;

class ApiService implements ApiServiceInterface
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    /** @var PodioOptions */
    protected $options;

    /** @var CurlService */
    protected $curlService;

    public function __construct(PodioOptions $options)
    {
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
    public function put($url, array $attributes = [], array $options = [])
    {
        return $this->request(self::PUT, $url, $attributes, $options);
    }

    /**
     * DELETE
     *
     * @param string $url
     * @param array $attributes
     * @param array $options
     */
    public function delete($url, array $attributes = [], array $options = [])
    {
        return $this->request(self::DELETE, $url, $attributes, $options);
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
        $this->curlService->curl(
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
