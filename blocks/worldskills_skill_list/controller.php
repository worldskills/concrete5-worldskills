<?php 
namespace Concrete\Package\WorldSkills\Block\WorldskillsSkillList;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Multilingual\Page\Section\Section;

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

    public function getSearchableContent()
    {
        $content = array();

        $skills = $this->getSkills();

        if (isset($skills['skills'])) {

            foreach ($skills['skills'] as $skill) {

                if (isset($skill['name']['text'])) {
                    $content[] = $skill['name']['text'];
                }
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
        // convert to int
        $args['sectorId'] = intval($args['sectorId']);

        // convert to string
        if (is_array($args['types'])) {
            $args['types'] = implode(',', $args['types']);
        } else {
            $args['types'] = '';
        }

        parent::save($args);
    }

    public function getSkills($sort = 'name_asc')
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

        // fix for sorting
        if ($locale == 'en_US') {
            $locale = 'en';
        }

        // defaults
        $params = array(
            'limit' => 100,
            'sort' => $sort,
            'l' => $locale,
        );

        // build URL with params
        $url = \Config::get('worldskills.api_url', 'https://api.worldskills.org') . '/events/' . $this->eventId . '/skills';
        $url .= '?';
        $url .= http_build_query($params);

        // block settings
        if ($this->sectorId) {
            $url .= '&';
            $url .= http_build_query(array('sector' => $this->sectorId));
        }
        if ($this->types) {
            $skillTypes = explode(',', $this->types);
            foreach ($skillTypes as $skillType) {
                $url .= '&';
                $url .= http_build_query(array('type' => $skillType));
            }
        }

        // fetch JSON
        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        return $data;
    }

    public function view()
    {
        $query = \Request::getInstance()->query;
        $sort = $query->get('worldskills_skill_list_sort', 'name_asc');

        $data = $this->getSkills($sort);

        $skills = $data['skills'];

        $this->set('skills', $skills);
    }
}
