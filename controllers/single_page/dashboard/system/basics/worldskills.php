<?php
namespace Concrete\Package\Worldskills\Controller\SinglePage\Dashboard\System\Basics;

use \Concrete\Core\Page\Controller\DashboardPageController;
use Loader;
use Config;

class Worldskills extends DashboardPageController
{
    public function view($strStatus = false)
    {
        $this->set('apiUrl', \Config::get('worldskills.api_url', 'https://api.worldskills.org'));
        $this->set('authorizeUrl', \Config::get('worldskills.authorize_url'));

        if ($strStatus == 'saved')
        {
            $message = t('Settings Saved.');
            $this->set('message', $message);
        }
    }

    public function save()
    {
        if ($this->isPost())
        {
            \Config::save('worldskills.api_url', $this->post('api_url'));
            \Config::save('worldskills.authorize_url', $this->post('authorize_url'));

            $this->redirect('/dashboard/system/basics/worldskills', 'saved');
        }

        $this->view();
    }
}
