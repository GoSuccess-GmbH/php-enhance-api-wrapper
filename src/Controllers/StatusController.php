<?php

namespace GoSuccess\Enhance\Controllers;
use GoSuccess\Enhance\Abstracts\Controller;
use GoSuccess\Enhance\Enumerations\HttpMethod;
use GoSuccess\Enhance\Enumerations\OrchdStatus;

class StatusController extends Controller
{
    /**
     * Get the readiness status of the orchd service.
     * 
     * @link https://apidocs.enhance.com/#/install/orchdStatus
     * @return \GoSuccess\Enhance\Enumerations\OrchdStatus
     */
    public function get(): OrchdStatus
    {
        $result = $this->api->request(
            method: HttpMethod::GET,
            endpoint: '/status'
        );

        return $result === null ? null : OrchdStatus::tryFrom( $result );
    }
}
