<?php 
namespace Concrete\Package\WorldSkills\Block\WorldskillsResults;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Multilingual\Page\Section\Section;

class Controller extends BlockController
{
    protected $btTable = 'btWorldSkillsResults';
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 400;
    protected $btDefaultSet = 'worldskills';
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $btCacheBlockOutputLifetime = 3600; // 1h

    public function getBlockTypeName()
    {
        return t('Results');
    }

    public function getBlockTypeDescription()
    {
        return t('WorldSkills Results');
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

        // fetch JSON
        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        return $data;
    }

    public function getResults()
    {
        // build URL with params
        $url = \Config::get('worldskills.api_url', 'https://api.worldskills.org') . '/results/events/' . $this->eventId;

        // fetch JSON
        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        return $data;
    }

    public function view()
    {
        $query = \Request::getInstance()->query;

        $data = $this->getSkills();
        $skills = $data['skills'];

        $data = $this->getResults();
        $results = $data['results'];

        $this->set('skills', $skills);
        $this->set('results', $results);
    }
}
