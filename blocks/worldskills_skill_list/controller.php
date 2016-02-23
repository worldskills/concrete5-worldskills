<?php 
namespace Concrete\Package\WorldSkills\Block\WorldskillsSkillList;

use Concrete\Core\Block\BlockController;

class Controller extends BlockController
{
    protected $btTable = 'btWorldSkillsSkillList';
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 400;
    protected $btDefaultSet = 'worldskills';

    public function getBlockTypeName()
    {
        return t('Skill list');
    }

    public function getBlockTypeDescription()
    {
        return t('List of skills');
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
    
    public function getSkills()
    {
        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url') . '/events/' . $this->eventId . '/skills';
        $url = $uh->buildQuery($url, array(
            'limit' => 100,
        ));

        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        return $data;
    }
    
    public function view()
    {
        $data = $this->getSkills();

        $skills = $data['skills'];

        $this->set('skills', $skills);
    }
}
