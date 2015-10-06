<?php 
namespace Concrete\Package\Worldskills;

use \Concrete\Core\Authentication\AuthenticationType;
use \Concrete\Core\Package\Package;
use \Concrete\Core\Page\Theme\Theme;

defined('C5_EXECUTE') or die("Access Denied.");

class Controller extends Package
{
    protected $pkgHandle = 'worldskills';
    protected $appVersionRequired = '5.7.3.1';
    protected $pkgVersion = '0.9.1';
    protected $pkgAllowsFullContentSwap = true;
    protected $pkgAutoloaderMapCoreExtensions = true;

    public function getPackageDescription()
    {
        return t("Theme for WorldSkills Members");
    }

    public function getPackageName()
    {
        return t("WorldSkills");
    }

    public function install()
    {
        $pkg = parent::install();
        $this->configurePackage($pkg);
    }

    public function upgrade()
    {
        parent::upgrade();

        $pkg = \Package::getByHandle($this->pkgHandle);
        $this->configurePackage($pkg);
    }

    public function configurePackage($pkg)
    {
        $theme = Theme::getByHandle('worldskills');
        if (!is_object($theme)) {
            $theme = Theme::add('worldskills', $pkg);
        }

        try {
            $authenticationType = AuthenticationType::getByHandle('worldskills');
        } catch (\Exception $e) {
            $authenticationType = AuthenticationType::add('worldskills', 'WorldSkills Auth', 0, $pkg);
            $authenticationType->disable();
        }

        $page = \SinglePage::add('/dashboard/system/basics/worldskills', $pkg);
        if (is_object($pag)) {
            $page->updateCollectionName('WorldSkills');
        }

        \Config::save('worldskills.api_url', \Config::get('worldskills.api_url', 'https://api.worldskills.org'));
        \Config::save('worldskills.authorize_url', \Config::get('worldskills.authorize_url', 'https://auth.worldskills.org'));
    }

    public function on_start()
    {
        $app = \Core::make('app');
        $provider = new \Concrete\Package\Worldskills\Authentication\ServiceProvider($app);
        $provider->register();
    }
}
