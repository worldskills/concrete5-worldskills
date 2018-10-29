<?php

namespace Concrete\Package\Worldskills\WorldSkills\Service;

class Auth
{
    protected $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getLoggedInUser($accessToken)
    {
        $url = $this->url . '/auth/users/loggedIn';

        $client = \Core::make('http/client');
        $client->setUri($url);
        $client->setHeaders(array('Authorization' => 'Bearer ' . $accessToken));

        // send request
        $response = $client->send();

        return $response;
    }

    public function logout($accessToken)
    {
        $url = $this->url . '/auth/sessions/logout';

        $client = \Core::make('http/client');
        $client->setUri($url);
        $client->setHeaders(array('Authorization' => 'Bearer ' . $accessToken));
        $client->setMethod('POST');

        // send request
        $response = $client->send();

        return $response;
    }
}
