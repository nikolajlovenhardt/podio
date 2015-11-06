<?php

namespace nlp\Podio\Authentication;

use nlp\Podio\Podio;
use nlp\Podio\Services\ApiServiceInterface;

class Authentication implements AuthenticationInterface
{
    /** @var Podio */
    protected $podio;

    /** @var ApiServiceInterface */
    protected $apiService;

    public function __construct(Podio $podio, ApiServiceInterface $apiService)
    {
        $this->podio = $podio;
        $this->apiService = $apiService;
    }

    /**
     * Authorize using app
     *
     * @param string $appId
     * @param string $appToken
     * @return bool
     */
    public function app($appId, $appToken)
    {
        return $this->authorize([
            'type' => 'app',
            'identifier' => $appId,
        ], [
            'grant_type' => 'app',
            'app_id' => $appId,
            'app_token' => $appToken,
        ]);
    }

    /**
     * Authorize using username and password
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login($username, $password)
    {
        return $this->authorize([
            'type' => 'password',
        ], [
            'grant_type' => 'password',
            'username' => $username,
            'password' => $password,
        ]);
    }

    /**
     * Authorize using authorization code
     *
     * @param string $code
     * @param null $redirectUri
     * @return bool
     */
    public function authorizationCode($code, $redirectUri = null)
    {
        return $this->authorize([
            'type' => 'authorization_code',
        ], [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirectUri,
        ]);
    }

    /**
     * Refresh token
     *
     * @param string $token
     * @return bool
     */
    public function refreshToken($token)
    {
        return $this->authorize([
            'type' => 'refresh_token',
        ], [
            'grant_type' => 'refresh_token',
            'refresh_token' => $token,
        ]);
    }

    /**
     * TODO: Check authorization & set authorized?
     *
     * @param array $authType
     * @param array $data
     * @return bool
     */
    protected function authorize(array $authType, array $data)
    {
        $response = $this->apiService->post(
            '/oauth/token',
            $data,
            [
                'oauth_request' => true,
            ]
        );

        // $this->podio->authorized = true?

        return true;
    }
}
