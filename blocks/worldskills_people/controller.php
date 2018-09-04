<?php 
namespace Concrete\Package\WorldSkills\Block\WorldskillsPeople;

use Concrete\Core\Block\BlockController;
use Concrete\Package\Worldskills\WorldSkills\Pagination\PaginatedList;

class Controller extends BlockController
{
    const BASE_POSITION_COMPETITOR = 'Competitor';

    const BASE_POSITION_EXPERT = 'Expert';

    protected $btTable = 'btWorldSkillsPeople';
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 400;
    protected $btDefaultSet = 'worldskills';
    protected $btCacheBlockOutput = false;

    public function getBlockTypeName()
    {
        return t('People');
    }

    public function getBlockTypeDescription()
    {
        return t('Show Competitors or Experts');
    }

    public function getSearchableContent()
    {
        $content = array();

        // get all people
        $params = array(
            'limit' => 999,
            'public_view_only' => 1,
            'show_inactive' => 1,
        );
        if ($this->skillId) {
            $params['skill'] = $this->skillId;
        } elseif ($this->eventId) {
            $params['event'] = $this->eventId;
        }
        if ($this->entityId) {
            $params['entity'] = $this->entityId;
        }
        $people = $this->getPeople($params);

        if (isset($people['people'])) {

            foreach ($people['people'] as $person) {

                $content[] = $person['first_name'];
                $content[] = $person['last_name'];
            }
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
        // get all Events for dropdown
        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url', 'https://api.worldskills.org') . '/events';
        $url = $uh->buildQuery($url, array(
            'type' => 'competition',
            'limit' => 100,
        ));

        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        $events = $data['events'];

        // get all Members for dropdown
        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url', 'https://api.worldskills.org') . '/org/members';
        $url = $uh->buildQuery($url, array(
            'limit' => 100,
        ));

        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        $members = $data['members'];

        // set form data
        $this->set('events', $events);
        $this->set('members', $members);
    }

    public function save($args)
    {
        $args['skillId'] = intval($args['skillId']);
        $args['entityId'] = intval($args['entityId']);
        parent::save($args);
    }

    public function getPeople($params)
    {
        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url', 'https://api.worldskills.org') . '/people';

        // Competitors resource
        if ($this->typeFilter == 'competitors') {
            $url .= '/competitors';
        }

        // Experts resource
        if ($this->typeFilter == 'experts') {
            $url .= '/experts';
        }

        // build URL with params
        $url = $uh->buildQuery($url, $params);

        // fetch JSON
        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        return $data;
    }

    public function view()
    {
        // $_GET user defined params
        $page = max(1, $this->get('page'));
        $name = trim($this->get('worldskills_people_name'));
        $entity = $this->get('worldskills_people_entity');
        $skill = $this->get('worldskills_people_skill');

        // defaults
        $limit = 100;
        $offset = ($page - 1) * $limit;

        $params = array(
            'limit' => $limit,
            'offset' => $offset,
            'public_view_only' => 1,
            'show_inactive' => 1,
            'sort' => 'lastname_asc',
        );

        // block settings
        if ($this->skillId) {
            $params['skill'] = $this->skillId;
        } elseif ($this->eventId) {
            $params['event'] = $this->eventId;
        }
        if ($this->entityId) {
            $params['entity'] = $this->entityId;
        }

        // user defined params
        if ($name) {
            $params['name'] = $name;
        }
        if ($entity) {
            $params['entity'] = $entity;
        }
        if ($skill) {
            $params['skill'] = $skill;
        }

        // get people
        $people = $this->getPeople($params);

        // convert to paginated list
        $people = new PaginatedList($people, 'people', $limit, $page);
        $people->addFilter('worldskills_people_name', $name);
        $people->addFilter('worldskills_people_entity', $entity);
        $people->addFilter('worldskills_people_skill', $skill);

        $this->set('people', $people);
        $this->set('basePositionCompetitor', self::BASE_POSITION_COMPETITOR);
        $this->set('basePositionExpert', self::BASE_POSITION_EXPERT);
    }
}
