<?php 
namespace Concrete\Package\WorldSkills\Block\WorldskillsSkill;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Multilingual\Page\Section\Section;

class Controller extends BlockController
{
    protected $btTable = 'btWorldSkillsSkill';
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 400;
    protected $btDefaultSet = 'worldskills';
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $btCacheBlockOutputLifetime = 3600; // 1h

    public function getBlockTypeName()
    {
        return t('Skill');
    }

    public function getBlockTypeDescription()
    {
        return t('Name and description of skill');
    }

    public function getSearchableContent()
    {
        $content = array();

        $skill = $this->getSkill();

        if (isset($skill['name']['text'])) {
            $content[] = $skill['name']['text'];
        }
        if (isset($skill['description']['text']) && $skill['description']['text']) {
            $content[] = $skill['description']['text'];
        }

		return implode(' ', $content);
    }

    public function edit()
    {
        $this->form();
    }

    public function add()
    {
        $this->form();
    }
    
    protected function form()
    {
        // fetch all competitions
        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url', 'https://api.worldskills.org') . '/events';
        $url = $uh->buildQuery($url, array(
            'type' => 'competition',
            'limit' => 100,
        ));

        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        $events = $data['events'];

        $this->set('events', $events);
    }

    public function save($args)
    {
        $args['skillId'] = intval($args['skillId']);
        parent::save($args);
    }

    public function getSkill()
    {
        // get locale
        $locale = \Localization::activeLocale();
        $c = $this->getCollectionObject();
        if (is_object($c)) {
            $al = Section::getBySectionOfSite($c);
            if (is_object($al)) {
                $locale = $al->getLocale();
            }
        }

        // build URL with params
        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url', 'https://api.worldskills.org') . '/events/' . $this->eventId . '/skills/' . $this->skillId;
        $url = $uh->buildQuery($url, array(
            'l' => $locale,
        ));

        // fetch JSON
        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        return $data;
    }

    public function view()
    {
        $skill = $this->getSkill();

        $this->set('skill', $skill);
    }
}
