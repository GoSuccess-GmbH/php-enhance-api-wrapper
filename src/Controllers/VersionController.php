<?php

namespace GoSuccess\Enhance\Controllers;
use GoSuccess\Enhance\Abstracts\Controller;
use GoSuccess\Enhance\Enumerations\HttpMethod;

class VersionController extends Controller
{
    /**
     * Get the SemVer of the API service.
     * 
     * @link https://apidocs.enhance.com/#/install/orchdVersion
     * @return string
     */
    public function get(): string
    {
        $result = $this->api->request(
            method: HttpMethod::GET,
            endpoint: '/version'
        );

        return $result === null ? null : $result;
    }
}
