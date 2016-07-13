<?php 
namespace Concrete\Package\WorldSkills\Block\WorldskillsMember;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Multilingual\Page\Section\Section;

class Controller extends BlockController
{
    protected $btTable = 'btWorldSkillsMember';
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 400;
    protected $btDefaultSet = 'worldskills';

    public function getBlockTypeName()
    {
        return t('Member');
    }

    public function getBlockTypeDescription()
    {
        return t('WorldSkills Member information');
    }

    public function getSearchableContent()
    {
        $content = array();

        $member = $this->getMember();

        if (isset($member['name']['text'])) {
            $content[] = $member['name']['text'];
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
        $url = \Config::get('worldskills.api_url', 'https://api.worldskills.org') . '/org/members';
        $url = $uh->buildQuery($url, array(
            'limit' => 100,
        ));

        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        $members = $data['members'];

        $this->set('members', $members);
    }

    public function getMember()
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

        // build URL with params
        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url', 'https://api.worldskills.org') . '/org/members/' . $this->memberId;
        $url = $uh->buildQuery($url, array(
            'l' => $locale,
        ));

        // fetch JSON
        $data = \Core::make("helper/file")->getContents($url);
        $data = json_decode($data, true);

        return $data;
    }

    public function view()
    {
        $member = $this->getMember();

        $this->set('member', $member);
    }
}
