<?php

namespace Concrete\Package\Worldskills\Authentication;

use OAuth\OAuth2\Service\AbstractService;
use OAuth\OAuth2\Token\StdOAuth2Token;
use OAuth\Common\Http\Exception\TokenResponseException;
use OAuth\Common\Http\Uri\Uri;

class Service extends AbstractService
{
    public function getAuthorizationEndpoint()
    {
        $uri = \Config::get('worldskills.authorize_url', 'https://auth.worldskills.org') . '/oauth/authorize';
        return new Uri($uri);
    }

    public function getAccessTokenEndpoint()
    {
        $uri = \Config::get('worldskills.api_url', 'https://api.worldskills.org') . '/auth/access_token';
        return new Uri($uri);
    }

    public function getAuthorizationMethod()
    {
        return static::AUTHORIZATION_METHOD_HEADER_BEARER;
    }

    protected function getExtraOAuthHeaders()
    {
        return array(
            'Accept' => 'application/json',
        );
    }

    protected function parseAccessTokenResponse($responseBody)
    {
        $data = json_decode($responseBody, true);

        if (null === $data || !is_array($data)) {
            throw new TokenResponseException('Unable to parse response.');
        } elseif (isset($data['error'])) {
            throw new TokenResponseException('Error in retrieving token: "' . $data['error'] . '"');
        }

        $token = new StdOAuth2Token();
        $token->setAccessToken($data['access_token']);

        return $token;
    }
}
