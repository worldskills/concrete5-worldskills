<?php 
namespace Concrete\Package\WorldSkills\Block\WorldskillsSkill;

use Concrete\Core\Block\BlockController;

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
        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url') . '/events/skills/' . $this->skillId;
        $url = $uh->buildQuery($url, array(
        ));

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
