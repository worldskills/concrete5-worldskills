<?php

namespace Concrete\Package\WorldSkills\Block\WorldskillsResources;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Authentication\AuthenticationType;

class Controller extends BlockController
{
    protected $btTable = 'btWorldSkillsResources';
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 400;
    protected $btDefaultSet = 'worldskills';

    public function getBlockTypeName()
    {
        return t('Resources');
    }

    public function getBlockTypeDescription()
    {
        return t('Displays document links for a given tags');
    }

    protected function getWorldSkillsAccessToken()
    {
        $at = AuthenticationType::getByHandle('worldskills');
        $controller = $at->getController();
        $accessToken = $controller->getWorldSkillsAccessToken();

        return $accessToken;
    }

    protected function getEvents()
    {
        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url', 'https://api.worldskills.org') . '/events';
        $url = $uh->buildQuery($url, array(
            'type' => 'competition',
            'limit' => 100,
        ));

        $data = \Core::make('helper/file')->getContents($url);
        $data = json_decode($data, true);

        return $data['events'];
    }

    protected function getSkills()
    {
        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url', 'https://api.worldskills.org') . '/events/' . $this->event . '/skills';
        $url = $uh->buildQuery($url, array(
            'limit' => 100,
            'sort' => 'sector_name_asc',
        ));

        $data = \Core::make('helper/file')->getContents($url);
        $data = json_decode($data, true);

        return $data['skills'];
    }

    protected function getEntities($accessToken = '')
    {
        $uh = \Core::make('helper/url');
        $url = \Config::get('worldskills.api_url', 'https://api.worldskills.org') . '/auth/ws_entities';
        $url = $uh->buildQuery($url, array(
            'limit' => 100,
        ));
        $client = \Core::make('http/client');
        $client->setUri($url);

        if ($accessToken) {
            $client->setHeaders(array('Authorization' => 'Bearer ' . $accessToken));
        }

        // send request
        $response = $client->send();

        // parse response
        $body = $response->getBody();
        $data = json_decode($body, true);

        return $data['ws_entity_list'];
    }

    protected function getResourceTypes()
    {
        $url = \Config::get('worldskills.api_url', 'https://api.worldskills.org') . '/resources/types';

        $data = \Core::make('helper/file')->getContents($url);
        $data = json_decode($data, true);

        return $data;
    }

    protected function getResources($accessToken = '')
    {
        $queryString = '?limit=-1';

        if ($this->entityId) {
            $queryString .= '&ws_entity=' . $this->entityId;
        }

        $tags = explode(',', $this->tags);
        foreach ($tags as $tag) {
            $tag = trim($tag);
            if ($tag) {
                $queryString .= '&tags=' . rawurlencode($tag);
            }
        }

        if ($this->type) {
            $queryString .= '&type=' . $this->type;
        }

        if ($this->sort) {
            $queryString .= '&sort=' . $this->sort;
        }

        $url = \Config::get('worldskills.api_url', 'https://api.worldskills.org') . '/resources' . $queryString;

        $client = \Core::make('http/client');
        $client->setUri($url);

        if ($accessToken) {
            $client->setHeaders(array('Authorization' => 'Bearer ' . $accessToken));
        }

        // send request
        $response = $client->send();

        // check for error
        if ($response->isClientError()) {
            return array();
        }

        // parse response
        $body = $response->getBody();
        $data = json_decode($body, true);

        return $data['resources'];
    }

    public function save($args)
    {
        $accessToken = $this->getWorldSkillsAccessToken();
        $entities = $this->getEntities($accessToken);

        $args['event'] = intval($args['event']);
        $args['type'] = intval($args['type']);
        $args['entityId'] = intval($args['entityId']);

        if (is_array($entities) && count($entities) > 0) {
            foreach ($entities as $entity) {
                if ($entity['id'] == $args['entityId']) {
                    $args['entityName'] = $entity['name']['text'];
                }
            }
        }

        parent::save($args);
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
        $accessToken = $this->getWorldSkillsAccessToken();

        // get all Events for dropdown
        $events = $this->getEvents();

        // get all Entities for dropdown
        $entities = $this->getEntities($accessToken);

        // get all types for dropdown
        $resourceTypes = $this->getResourceTypes($accessToken);

        // set form data
        $this->set('events', $events);
        $this->set('entities', $entities);
        $this->set('resourceTypes', $resourceTypes);
    }

    public function view()
    {
        $accessToken = $this->getWorldSkillsAccessToken();

        $resources = $this->getResources($accessToken);

        $this->set('resources', $resources);
        $this->set('the_type', $this->type);
        $this->set('token', $accessToken);

        if (isset($this->event)){
            $skills = $this->getSkills();
            $this->set('skills', $skills);
        }
    }

    public function getSearchableContent()
    {
        $parts = array();

        $resources = $this->getResources();

        foreach ($resources as $document) {

            $parts[] = $document['name']['text'];

            foreach ($document['metadata'] as $metadata) {
                $parts[] = $metadata['value'];
            }

            foreach ($document['tags'] as $tag) {
                $parts[] = $tag;
            }

            foreach ($document['versions'] as $version) {
                foreach ($version['translations'] as $translation) {
                    $parts[] = $translation['filename'];
                }
            }
        }

        return implode(' ', $parts);
    }
}
