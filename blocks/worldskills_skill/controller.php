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
        $url = \Config::get('worldskills.api_url') . '/events';
        $url = $uh->buildQuery($url, array(
            'type' => 'competition',
            'limit' => 100,
        ));

        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        $events = $data['events'];

        $this->set('events', $events);
    }

    public function getSkill()
    {
        // get locale
        $c = $this->getCollectionObject();
        $al = Section::getBySectionOfSite($c);
        $locale = \Localization::activeLocale();
        if (is_object($al)) {
            $locale = $al->getLocale();
        }

        // build URL with params
        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url') . '/events/' . $this->eventId . '/skills/' . $this->skillId;
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
