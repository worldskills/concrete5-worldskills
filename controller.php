<?php 
namespace Concrete\Package\Worldskills;

use \Concrete\Core\Package\Package;
use \Concrete\Core\Page\Theme\Theme;

defined('C5_EXECUTE') or die("Access Denied.");

class Controller extends Package
{
    protected $pkgHandle = 'worldskills';
    protected $appVersionRequired = '5.7.3.1';
    protected $pkgVersion = '0.9.0';

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
        Theme::add('worldskills', $pkg);
    }
}
