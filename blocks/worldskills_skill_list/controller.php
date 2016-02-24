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
    
    public function getSkills($sort = 'name_asc')
    {
        // get locale
        $c = $this->getCollectionObject();
        $al = Section::getBySectionOfSite($c);
        $locale = \Localization::activeLocale();
        if (is_object($al)) {
            $locale = $al->getLanguage();
        }

        // fix for sorting
        if ($locale == 'en_US') {
            $locale = 'en';
        }

        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url') . '/events/' . $this->eventId . '/skills';
        $url = $uh->buildQuery($url, array(
            'limit' => 100,
            'sort' => $sort,
            'l' => $locale,
        ));

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
