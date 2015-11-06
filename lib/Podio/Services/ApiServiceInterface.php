<?php

namespace nlp\Podio\Services;

interface ApiServiceInterface
{
    public function get($url, array $attributes = [], array $options = []);

    public function post($url, array $attributes = [], array $options = []);

    public function put($url, array $attributes = []);

    public function delete($url, array $attributes = []);

    public function request($method, $url, array $attributes = [], array $options = []);
}
