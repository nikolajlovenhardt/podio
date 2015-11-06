<?php

namespace nlp\Podio;

use nlp\Podio\Options\PodioOptions;
use nlp\Podio\Services\CurlService;

class Podio
{
    const VERSION = '4.3.0';

    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    /** @var PodioOptions */
    protected $options;

    /** @var CurlService */
    protected $curlService;

    /** @var array */
    protected $credentials = [];

    public function __construct($clientId, $clientSecret, array $options = [])
    {
        $this->options = new PodioOptions($options);
        $this->curlService = new CurlService($this->options);

        // Setup application
        $this->setCredentials($clientId, $clientSecret);
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
