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
            // GET Request
            case ApiService::GET:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, ApiService::GET);

                // Headers
                $headers['Content-type'] = 'application/x-www-form-urlencoded';
                $headers['Content-length'] = '0';

                $url = $this->generateUrl($url, $attributes);
                break;

            // POST request
            case ApiService::POST:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, ApiService::POST);

                // Headers
                $headers['Content-type'] = 'application/x-www-form-urlencoded';
                $headers['Content-length'] = '0';

                $this->setPostFields($curl, $attributes, false, true);

                // Upload
                if (isset($options['upload']) && $options['upload']) {
                    curl_setopt($curl, CURLOPT_POST, true);

                    // Safe upload
                    if(defined('CURLOPT_SAFE_UPLOAD')) {
                        curl_setopt($curl, CURLOPT_SAFE_UPLOAD, false);
                    }

                    // Attributes
                    $this->setPostFields($curl, $attributes);
                }

                // oauth
                if (isset($options['oauth']) && $options['oauth']) {
                    // Attributes
                    $this->setPostFields($curl, $attributes, true);

                    // Header
                    $headers['Content-type'] = 'application/json';
                }
                break;

            // PUT request
            case ApiService::PUT:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, ApiService::PUT);

                $headers['Content-type'] = 'application/json';

                // Attributes
                $this->setPostFields($curl, $attributes, true);
                break;

            // DELETE request
            case ApiService::DELETE:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, ApiService::DELETE);

                // Header
                $headers['Content-type'] = 'application/x-www-form-urlencoded';
                $headers['Content-length'] = '0';

                $url = $this->generateUrl($url, $attributes);
                break;

            default:
                // Throw exception
                break;
        }

        // Set headers
        $this->setHeaders($curl, array_merge($defaultHeaders, $headers));
        $this->setUrl($curl, $url);

        // Result
        $response = curl_exec($curl);

        curl_close($curl);
    }

    /**
     * Set url
     *
     * @param $curl
     * @param string $url
     */
    protected function setUrl($curl, $url)
    {
        curl_setopt($curl, CURLOPT_URL, $url);
    }

    /**
     * Set post fields
     *
     * @param $curl
     * @param array $attributes
     * @param bool|false $jsonEncode
     */
    protected function setPostFields($curl, array $attributes = [], $jsonEncode = false, $encoded = false)
    {
        if ($jsonEncode) {
            $attributes = json_encode($jsonEncode, true);
        }

        if ($encoded) {
            // TODO: HTTP QUERY
        }

        curl_setopt($curl, CURLOPT_POSTFIELDS, $attributes);
    }

    /**
     * Generate url with http query
     *
     * @param string $url
     * @param array $attributes
     * @return string
     */
    public function generateUrl($url, array $attributes = [])
    {
        $query = http_build_query($attributes);
        $separator = strpos($url, '?') ? '&' : '?';

        return $url . $separator . $query;
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
