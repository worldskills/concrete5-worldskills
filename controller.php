<?php 
namespace Concrete\Package\Worldskills;

use \Concrete\Core\Authentication\AuthenticationType;
use \Concrete\Core\Package\Package;
use \Concrete\Core\Page\Theme\Theme;
use \Concrete\Core\Page\Type\PublishTarget\Type\AllType as PageTypePublishTargetAllType;
use \Concrete\Core\Page\Type\PublishTarget\Configuration\AllConfiguration as PageTypePublishTargetAllConfiguration;
use Concrete\Core\Attribute\Key\CollectionKey as CollectionAttributeKey;
use \Concrete\Core\Attribute\Type as AttributeType;

defined('C5_EXECUTE') or die("Access Denied.");

class Controller extends Package
{
    protected $pkgHandle = 'worldskills';
    protected $appVersionRequired = '5.7.3.1';
    protected $pkgVersion = '0.9.31';
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

        // add skill ID attribute
        $attributeKey = CollectionAttributeKey::getByHandle('worldskills_skill_id');
        if (!is_object($attributeKey)) {
            $type = AttributeType::getByHandle('text');
            $args = array(
                'akHandle' => 'worldskills_skill_id',
                'akName' => t('Skill ID'),
                'akIsSearchable' => 1,
                'akIsSearchableIndexed' => 1,
            );
            CollectionAttributeKey::add($type, $args, $pkg);
        }

        // add skill page type
        $pageType = \PageType::getByHandle('worldskills_skill');
        if (!is_object($pageType)){
            $template = \PageTemplate::getByHandle('full');
            \PageType::add(array(
                'handle' => 'worldskills_skill',
                'name' => 'Skill',
                'defaultTemplate' => $template,
                'allowedTemplates' => 'C',
                'templates' => array($template),
                'ptLaunchInComposer' => 0,
                'ptIsFrequentlyAdded' => 0,
            ), $pkg)->setConfiguredPageTypePublishTargetObject(new PageTypePublishTargetAllConfiguration(PageTypePublishTargetAllType::getByHandle('all')));
        }

        // add member ID attribute
        $attributeKey = CollectionAttributeKey::getByHandle('worldskills_member_id');
        if (!is_object($attributeKey)) {
            $type = AttributeType::getByHandle('text');
            $args = array(
                'akHandle' => 'worldskills_member_id',
                'akName' => t('Member ID'),
                'akIsSearchable' => 1,
                'akIsSearchableIndexed' => 1,
            );
            CollectionAttributeKey::add($type, $args, $pkg);
        }

        // add member page type
        $pageType = \PageType::getByHandle('worldskills_member');
        if (!is_object($pageType)){
            $template = \PageTemplate::getByHandle('full');
            \PageType::add(array(
                'handle' => 'worldskills_member',
                'name' => 'Member',
                'defaultTemplate' => $template,
                'allowedTemplates' => 'C',
                'templates' => array($template),
                'ptLaunchInComposer' => 0,
                'ptIsFrequentlyAdded' => 0,
            ), $pkg)->setConfiguredPageTypePublishTargetObject(new PageTypePublishTargetAllConfiguration(PageTypePublishTargetAllType::getByHandle('all')));
        }

        // add skill block
        $blockType = \BlockType::getByHandle('worldskills_skill');
        if (!is_object($blockType)) {
            \BlockType::installBlockTypeFromPackage('worldskills_skill', $pkg);
        }

        // add skill list block
        $blockType = \BlockType::getByHandle('worldskills_skill_list');
        if (!is_object($blockType)) {
            \BlockType::installBlockTypeFromPackage('worldskills_skill_list', $pkg);
        }

        // add people block
        $blockType = \BlockType::getByHandle('worldskills_people');
        if (!is_object($blockType)) {
            \BlockType::installBlockTypeFromPackage('worldskills_people', $pkg);
        }

        // add member block
        $blockType = \BlockType::getByHandle('worldskills_member');
        if (!is_object($blockType)) {
            \BlockType::installBlockTypeFromPackage('worldskills_member', $pkg);
        }

        // add member list block
        $blockType = \BlockType::getByHandle('worldskills_member_list');
        if (!is_object($blockType)) {
            \BlockType::installBlockTypeFromPackage('worldskills_member_list', $pkg);
        }

        // add results block
        $blockType = \BlockType::getByHandle('worldskills_results');
        if (!is_object($blockType)) {
            \BlockType::installBlockTypeFromPackage('worldskills_results', $pkg);
        }

        // add resources block
        $blockType = \BlockType::getByHandle('worldskills_resources');
        if (!is_object($blockType)) {
            \BlockType::installBlockTypeFromPackage('worldskills_resources', $pkg);
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
