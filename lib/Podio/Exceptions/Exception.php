<?php

namespace nlp\Podio\Exceptions;

class Exception extends \Exception
{
    /** @var string */
    public $body;

    /** @var int */
    public $status;

    /** @var \Exception */
    public $url;

    public function __construct($body, $status, $url)
    {
        $this->body = json_decode($body, TRUE);
        $this->status = $status;
        $this->url = $url;
        $this->request = $this->body['request'];

        parent::__construct(get_class($this), 1, null);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $text = [];

        $text[] = get_class($this);
        $request = $this->request;

        // Error description
        if (!empty($this->body['error_description'])) {
            $text[] = sprintf(': "%s"', $this->body['error_description']);
        }

        $url = sprintf('Request URL: %s', $request['url']);

        // Query string
        if (!empty($request['query_string'])) {
            $url .= '?' . $request['query_string'];
        }

        $text[] = $url;

        // Body
        if (!empty($request['body'])) {
            $text[] .= sprintf('Request body: %s', json_encode($request['body']));
        }

        // Stack trace
        $text[] = sprintf("Stack trace:\n%s", $this->getTraceAsString());

        return implode("\n", $text);
    }
}
