<?php

namespace Concrete\Package\Worldskills\Authentication;

use Concrete\Core\Authentication\Type\OAuth\OAuth2\GenericOauth2TypeController;
use Concrete\Core\User\User;

class Controller extends GenericOauth2TypeController
{
    public function registrationGroupID()
    {
        return \Config::get('auth.worldskills.registration.group');
    }

    public function supportsRegistration()
    {
        return true;
    }

    public function getAuthenticationTypeIconHTML()
    {
        return '<i class="fa fa-lock"></i>';
    }

    public function getHandle()
    {
        return 'worldskills';
    }

    public function getService()
    {
        if (!$this->service) {
            $this->service = \Core::make('authentication/worldskills');
        }
        return $this->service;
    }

    public function saveAuthenticationType($args)
    {
        \Config::save('auth.worldskills.appid', $args['apikey']);
        \Config::save('auth.worldskills.secret', $args['apisecret']);
        \Config::save('auth.worldskills.roles_application_code', $args['roles_application_code']);
        \Config::save('auth.worldskills.registration.group', intval($args['registration_group'], 10));
    }

    public function edit()
    {
        $this->set('form', \Loader::helper('form'));
        $this->set('apikey', \Config::get('auth.worldskills.appid', ''));
        $this->set('apisecret', \Config::get('auth.worldskills.secret', ''));
        $this->set('rolesApplicationCode', \Config::get('auth.worldskills.roles_application_code', ''));

        $list = new \GroupList();
        $list->includeAllGroups();
        $this->set('groups', $list->getResults());
    }

    public function getWorldSkillsAccessToken()
    {
        $service = $this->getService();
        $serviceClass = $service->service();
        $storage = $service->getStorage();

        if ($storage->hasAccessToken($serviceClass)) {

            $token = $storage->retrieveAccessToken($serviceClass);

            return $token->getAccessToken();
        }

        return null;
    }

    protected function attemptAuthentication()
    {
        $user = parent::attemptAuthentication();

        $userInfo = \UserInfo::getByID($user->getUserID());

        $extractor = $this->getExtractor();
        $roles = $extractor->getExtra('roles');

        // sync groups with roles
        if (is_array($roles)) {

            $groupIds = array();
            foreach ($roles as $role) {

                $roleApplicationCode = $role['role_application']['application_code'];
                if ($roleApplicationCode == \Config::get('auth.worldskills.roles_application_code')) {
    
                    $roleName = $role['name'];

                    // check for entity role and append entity name
                    if (isset($role['ws_entity'])) {
                        $roleName = $roleName . ' - ' . $role['ws_entity']['name']['text'];
                    }

                    // check if group exists
                    $group = \Group::getByName($roleName);
                    if (!is_object($group)) {

                        // add missing groups
                        $group = \Group::add($roleName, '');
                    }

                    $groupIds[] = $group->getGroupID();
                }
            }

            // remove duplicate groups
            $groupIds = array_unique($groupIds);

            // update groups of user
            $userInfo->updateGroups($groupIds);
        }

        // login user again to make sure groups are reloaded
        return \User::loginByUserID($user->getUserID());
    }

    public function deauthenticate(User $u)
    {
        $auth = $this->app->make('worldskills/service/auth');
        $accessToken = $this->getWorldSkillsAccessToken();

        if ($accessToken) {
            $response = $auth->logout($accessToken);
        }
    }
}
