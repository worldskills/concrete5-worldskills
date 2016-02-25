<?php 
namespace Concrete\Package\WorldSkills\Block\WorldskillsPeople;

use Concrete\Core\Block\BlockController;
use Concrete\Package\Worldskills\WorldSkills\Pagination\PaginatedList;

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

    public function getPeople($params)
    {
        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url') . '/people';

        if ($this->typeFilter == 'competitors') {
            $url .= '/competitors';
        }

        if ($this->typeFilter == 'experts') {
            $url .= '/experts';
        }

        $url = $uh->buildQuery($url, $params);

        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        return $data;
    }

    public function view()
    {
        $page = max(1, $this->get('page'));
        $name = trim($this->get('worldskills_people_name'));
        $entity = $this->get('worldskills_people_entity');
        $skill = $this->get('worldskills_people_skill');

        $limit = 54;
        $offset = ($page - 1) * $limit;

        $params = array(
            'limit' => $limit,
            'offset' => $offset,
            'public_view_only' => 1,
            'sort' => 'lastname_asc',
        );
        
        if ($this->skillId) {
            $params['skill'] = $this->skillId;
        } elseif ($this->eventId) {
            $params['event'] = $this->eventId;
        }

        if ($name) {
            $params['name'] = $name;
        }
        if ($entity) {
            $params['entity'] = $entity;
        }
        if ($skill) {
            $params['skill'] = $skill;
        }

        $people = $this->getPeople($params);

        $people = new PaginatedList($people, 'people', $limit, $page);
        $people->addFilter('worldskills_people_name', $name);
        $people->addFilter('worldskills_people_entity', $entity);
        $people->addFilter('worldskills_people_skill', $skill);

        $this->set('people', $people);
    }
}
