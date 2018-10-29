<?php

namespace Concrete\Package\Worldskills\Authentication;

use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Storage\SymfonySession;
use OAuth\ServiceFactory;

class ServiceProvider extends \Concrete\Core\Foundation\Service\Provider
{
    public function register()
    {
        $config = $this->app->make('config');

        /** @var ExtractorFactory $extractor */
        $extractor = $this->app->make('oauth/factory/extractor');
        $extractor->addExtractorMapping('Concrete\\Package\\Worldskills\\Authentication\\Service', 'Concrete\\Package\\Worldskills\\Authentication\\Extractor');

        /** @var ServiceFactory $factory */
        $factory = $this->app->make('oauth/factory/service');
        $factory->registerService('worldskills', '\\Concrete\\Package\\Worldskills\\Authentication\\Service');

        $this->app->bindShared('authentication/worldskills', function () use ($factory) {

            $callback = '/ccm/system/authentication/oauth2/worldskills/callback/';

            $credentials = new Credentials(\Config::get('auth.worldskills.appid'), \Config::get('auth.worldskills.secret'), (string) \URL::to($callback));

            $session = new SymfonySession(\Session::getFacadeRoot(), false);

            return $factory->createService('worldskills', $credentials, $session);
        });

        $this->app->singleton('worldskills/service/auth', function ($app) use ($config) {

            return new \Concrete\Package\Worldskills\WorldSkills\Service\Auth(
                $config->get('worldskills.api_url', 'https://api.worldskills.org')
            );
        });

        $this->app->singleton('worldskills/accesss_token_check', function ($app) use ($config) {

            return new \Concrete\Package\Worldskills\WorldSkills\AccessTokenCheck(
                $app->make('session'),
                $app->make('worldskills/service/auth')
            );
        });

    }
}
