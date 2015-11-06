<?php

namespace nlp\Podio\Authentication;

interface AuthenticationInterface
{
    /**
     * Authenticate using app
     *
     * @param string $appId
     * @param string $appToken
     * @return boolean
     */
    public function app($appId, $appToken);

    /**
     * Authenticate using username and password
     *
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function login($username, $password);

    /**
     * Authenticate using authorization code
     *
     * @param $code
     * @param string|null $redirectUri
     * @return mixed
     */
    public function authorizationCode($code, $redirectUri = null);

    /**
     * Refresh token
     *
     * @param string $token
     * @return boolean
     */
    public function refreshToken($token);
}
