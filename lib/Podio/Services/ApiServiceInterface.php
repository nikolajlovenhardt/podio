<?php

namespace nlp\Podio\Services;

interface ApiServiceInterface
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    public function get();

    public function post();

    public function put();

    public function delete();

    public function request($method, $url, array $attributes = [], array $options = []);
}
