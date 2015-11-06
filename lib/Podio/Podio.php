<?php

namespace nlp\Podio;

use nlp\Podio\Authentication\Authentication;
use nlp\Podio\Options\PodioOptions;
use nlp\Podio\Services\ApiService;
use nlp\Podio\Services\CurlService;
use nlp\Podio\Services\CurlServiceInterface;

class Podio
{
    const VERSION = '4.3.0';

    /** @var PodioOptions */
    protected $options;

    /** @var CurlServiceInterface */
    protected $curlService;

    /** @var ApiService */
    protected $apiService;

    /** @var array */
    protected $credentials = [];

    public function __construct($clientId, $clientSecret, array $options = [])
    {
        $options = new PodioOptions($options);
        $this->options = $options;

        $this->curlService = new CurlService($options);

        $this->apiService = new ApiService(
            $options,
            $this->curlService
        );

        // Setup application
        $this->setCredentials($clientId, $clientSecret);
    }

    /**
     * Authenticate
     *
     * @return Authentication
     */
    public function authenticate()
    {
        return new Authentication($this->apiService);
    }

    /**
     * Set credentials
     *
     * @param string $clientId
     * @param string $clientSecret
     */
    public function setCredentials($clientId, $clientSecret)
    {
        $this->credentials = [
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
        ];
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
