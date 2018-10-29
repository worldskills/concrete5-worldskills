<?php

namespace Concrete\Package\Worldskills\WorldSkills;

use Concrete\Core\Authentication\AuthenticationType;
use Concrete\Core\Url\Url;
use Concrete\Core\Routing\RedirectResponse;

class Logout
{
    protected $auth;

    public function __construct($auth)
    {
        $this->auth = $auth;
    }

    public function logout($event)
    {
        $at = AuthenticationType::getByHandle('worldskills');
        $controller = $at->getController();
        $accessToken = $controller->getWorldSkillsAccessToken();

        if ($accessToken) {
            $response = $this->auth->logout($accessToken);
        }
    }
}
