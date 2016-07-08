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

    public function getSearchableContent()
    {
        $content = array();

        $members = $this->getMembers();

        if (isset($members['members'])) {

            foreach ($members['members'] as $member) {

                $content[] = $member['name']['text'];

                if (isset($member['organization']['name']['text']) && $member['organization']['name']['text']) {
                    $content[] = $member['organization']['name']['text'];
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
        // get all Members for dropdown
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

        $params = array(
            'limit' => 100,
            'member_of' => $this->parentId,
            'sort' => '1058',
            'l' => $locale,
        );

        // build URL with params
        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url') . '/org/members';
        $url = $uh->buildQuery($url, $params);

        // fetch JSON
        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        return $data;
    }

    public function view()
    {
        $data = $this->getMembers();

        $members = $data['members'];

        $this->set('members', $members);
    }
}
