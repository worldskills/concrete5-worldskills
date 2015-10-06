<?php

namespace Concrete\Package\Worldskills\Authentication;

use OAuth\Common\Http\Uri\Uri;
use OAuth\UserData\Extractor\LazyExtractor;
use OAuth\UserData\Utils\ArrayUtils;

class Extractor extends LazyExtractor
{
    public function __construct()
    {
        parent::__construct($this->getDefaultLoadersMap(), $this->getNormalizersMap(), $this->getSupports());
    }

    public function getSupports()
    {
        return array(
            self::FIELD_EMAIL,
            self::FIELD_FIRST_NAME,
            self::FIELD_LAST_NAME,
            self::FIELD_UNIQUE_ID,
            self::FIELD_USERNAME,
            self::FIELD_EXTRA,
        );
    }

    protected function getNormalizersMap()
    {
        return array(
            self::FIELD_EMAIL => 'email',
            self::FIELD_FIRST_NAME => 'firstName',
            self::FIELD_LAST_NAME => 'lastName',
            self::FIELD_UNIQUE_ID => 'id',
            self::FIELD_USERNAME => 'username',
            self::FIELD_EXTRA => 'extra',
        );
    }

    public function idNormalizer($data)
    {
        return isset($data['id']) ? intval($data['id']) : null;
    }

    public function emailNormalizer($data)
    {
        return isset($data['username']) ? $data['username'] : null;
    }

    public function firstNameNormalizer($data)
    {
        return isset($data['first_name']) ? $data['first_name'] : null;
    }

    public function lastNameNormalizer($data)
    {
        return isset($data['last_name']) ? $data['last_name'] : null;
    }

    public function usernameNormalizer($data)
    {
        return isset($data['username']) ? $data['username'] : null;
    }

    public function profileLoader()
    {
        $uri = \Config::get('worldskills.api_url') . '/auth/users/loggedIn';
        $uriParsed = new Uri($uri);

        return json_decode($this->service->request($uriParsed), true);
    }

    public function extraNormalizer($data)
    {
        return ArrayUtils::removeKeys($data, array(
            'id',
            'first_name',
            'last_name',
            'username',
        ));
    }
}
