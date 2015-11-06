<?php

namespace nlp\Podio\Services;

use nlp\Podio\Options\PodioOptions;
use nlp\Podio\Podio;

class CurlService implements CurlServiceInterface
{
    /** @var PodioOptions */
    protected $options;

    public function __construct(PodioOptions $options)
    {
        $this->options = $options;
    }

    public function curl($method, $url, array $attributes = [], array $headers = [])
    {
        $options = $this->options->get('curl');
        $defaultHeaders = $options['headers'];

        // Initiate curl
        $curl = curl_init();
        $this->prepare($curl);

        // Type
        switch ($method) {
            case ApiService::GET:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, ApiService::GET);
                break;

            case ApiService::POST:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, ApiService::POST);

                break;

            case ApiService::PUT:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, ApiService::PUT);

                break;

            case ApiService::DELETE:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, ApiService::DELETE);

                break;

            default:
                // Throw exception
                break;
        }

        // Set headers
        $this->setHeaders($curl, array_merge($defaultHeaders, $headers));

        curl_close($curl);
    }

    /**
     * Prepare curl
     *
     * @param $curl
     */
    protected function prepare($curl)
    {
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Podio PHP Client/' . Podio::VERSION);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);

        $this->setCurlOptions($curl);
        $this->setCertificate($curl);
    }

    /**
     * Set headers
     *
     * @param $curl
     * @param array $list
     * @return bool
     */
    protected function setHeaders($curl, $list = [])
    {
        $headers = [];

        foreach ($list as $key => $value) {
            $headers[] = $key . ':' . $value;
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        return true;
    }

    /**
     * Set curl options
     *
     * @param $curl
     * @return bool
     */
    protected function setCurlOptions($curl)
    {
        $curlOptions = $this->options->get('curl');

        if (!$curlOptions['options']) {
            return false;
        }

        curl_setopt_array($curl, $curlOptions['options']);

        return true;
    }

    /**
     * Set curl certificate
     *
     * @param $curl
     * @return bool
     */
    protected function setCertificate($curl)
    {
        if (!class_exists('\\Kdyby\\CurlCaBundle\\CertificateHelper')) {
            return false;
        }

        \Kdyby\CurlCaBundle\CertificateHelper::setCurlCaInfo($curl);

        return true;
    }
}
