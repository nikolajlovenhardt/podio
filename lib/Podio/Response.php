<?php

namespace nlp\Podio;

use nlp\Podio\Collections\ArrayCollection;

class Response
{
    /** @var string */
    protected $url;

    /** @var integer */
    protected $status;

    /** @var string */
    protected $body;

    /** @var ArrayCollection */
    protected $headers;

    public function __construct()
    {
        $this->headers = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return ArrayCollection
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param ArrayCollection $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return mixed|array|ArrayCollection
     */
    public function toArray()
    {
        $array = json_decode($this->body, true);

        if (!is_array($array)) {
            return $array;
        }

        return new ArrayCollection($array);
    }
}
