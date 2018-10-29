<?php

namespace Concrete\Package\Worldskills\WorldSkills;

use Concrete\Core\Authentication\AuthenticationType;
use Concrete\Core\Url\Url;
use Concrete\Core\Routing\RedirectResponse;

class AccessTokenCheck
{
    const LAST_PING_TIMEOUT = 600; // 5 minutes

    const LAST_PING_SESSION_KEY = 'worldskills_last_ping';

    protected $session;

    protected $auth;

    public function __construct($session, $auth)
    {
        $this->session = $session;
        $this->auth = $auth;
    }

    public function checkAccessToken($event)
    {
        $view = $event->getArgument('view');
        $path = $view->getViewPath();

        if ($path != '/login') {

            $user = new \User();

            if ($user->isLoggedIn()) {

                $at = AuthenticationType::getByHandle('worldskills');
                $controller = $at->getController();
                $accessToken = $controller->getWorldSkillsAccessToken();

                if ($accessToken) {

                    $lastPing = $this->session->get(self::LAST_PING_SESSION_KEY);

                    $now = time();
                    $diff = $now - $lastPing;
                    if ($diff > self::LAST_PING_TIMEOUT) {

                        $logout = false;

                        $response = $this->auth->getLoggedInUser($accessToken);

                        // check for error
                        if ($response->isClientError()) {
                            $logout = true;
                        } else {
                            $userId = $controller->getBindingForUser($user);
                            $authUser = json_decode($response->getBody(), true);
                            if (!isset($authUser['id']) || $userId != $authUser['id']) {
                                $logout = true;
                            }
                        }

                        if ($logout) {

                            // access token check failed, logout
                            $user->unloadCollectionEdit();
                            $user->invalidateSession();

                            // reload
                            $request = \Request::getInstance();
                            $url = Url::createFromUrl($request->getUri());
                            $response = new RedirectResponse($url);
                            $response->setRequest($request);
                            $response->send();

                        } else {
                            $this->session->set(self::LAST_PING_SESSION_KEY, $now);
                        }
                    }
                }
            }
        }
    }
}
