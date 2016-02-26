<?php 
namespace Concrete\Package\WorldSkills\Block\WorldskillsMemberList;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Multilingual\Page\Section\Section;

class Controller extends BlockController
{
    protected $btTable = 'btWorldSkillsMemberList';
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 400;
    protected $btDefaultSet = 'worldskills';

    public function getBlockTypeName()
    {
        return t('Member list');
    }

    public function getBlockTypeDescription()
    {
        return t('List of WorldSkills Members');
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
        $url = \Config::get('worldskills.api_url') . '/org/members';
        $url = $uh->buildQuery($url, array(
            'limit' => 100,
        ));

        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        $members = $data['members'];

        $this->set('members', $members);
    }

    public function getMembers()
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

        $params = array(
            'limit' => 100,
            'member_of' => $this->parentId,
            'l' => $locale,
        );

        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url') . '/org/members';
        $url = $uh->buildQuery($url, $params);

        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        return $data;
    }

    public function view()
    {
        $data = $this->getMembers($sort);

        $members = $data['members'];

        $this->set('members', $members);
    }
}
