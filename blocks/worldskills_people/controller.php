<?php 
namespace Concrete\Package\WorldSkills\Block\WorldskillsPeople;

use Concrete\Core\Block\BlockController;

class Controller extends BlockController
{
    protected $btTable = 'btWorldSkillsPeople';
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 400;
    protected $btDefaultSet = 'worldskills';

    public function getBlockTypeName()
    {
        return t('People');
    }

    public function getBlockTypeDescription()
    {
        return t('Show Competitors or Experts');
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

    public function save($args)
    {
        $args['skillId'] = intval($args['skillId']);
        parent::save($args);
    }

    public function getPeople()
    {
        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url') . '/people';

        $params = array(
            'limit' => 100,
        );

        if ($this->typeFilter == 'competitors') {
            $url .= '/competitors';
        }

        if ($this->typeFilter == 'experts') {
            $url .= '/experts';
        }

        if ($this->skillId) {
            $params['skill'] = $this->skillId;
        } elseif ($this->eventId) {
            $params['event'] = $this->eventId;
        }

        $url = $uh->buildQuery($url, $params);

        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        return $data;
    }

    public function view()
    {
        $people = $this->getPeople();

        $this->set('people', $people);
    }
}
