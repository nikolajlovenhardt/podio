<?php

namespace nlp\Podio\Services;

interface ApiServiceInterface
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    public function get($url, array $attributes = [], array $options = []);

    public function post($url, array $attributes = [], array $options = []);

    public function put($url, array $attributes = [], array $options = []);

    public function delete($url, array $attributes = [], array $options = []);

    public function request($method, $url, array $attributes = [], array $options = []);
}
