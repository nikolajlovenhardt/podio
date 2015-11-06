<?php

namespace nlp\Podio\Options;

class PodioOptions extends Options implements OptionsInterface
{
    /** @var array */
    protected $defaults = [
        // Debug mode
        'debug' => false,

        // API URL
        'apiUrl' => 'https://api.podio.com:443',

        // Curl options
        'curl' => [
            'headers' => [
                'Accept' => 'application/json',
            ],

            'options' => [],
        ],
    ];
}
