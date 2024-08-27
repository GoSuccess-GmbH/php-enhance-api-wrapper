<?php

namespace GoSuccess\Enhance\Controllers;
use GoSuccess\Enhance\Abstracts\Controller;
use GoSuccess\Enhance\Enumerations\HttpMethod;
use GoSuccess\Enhance\Models\LoginInfo;
use GoSuccess\Enhance\Models\NewResourceUuid;

class LoginController extends Controller
{
    /**
     * Creates a login in the realm. The login will be created in the same realm
     * that the organization is in. Session holder must have admin or support
     * privileges in the given organization or any parent thereof.
     * 
     * @link https://apidocs.enhance.com/#/logins/createLogin
     * @param \GoSuccess\Enhance\Models\LoginInfo $login_info
     * @return NewResourceUuid|null
     */
    public function create_login( LoginInfo $login_info ): ?NewResourceUuid
    {
        $result = $this->api->request(
            method: HttpMethod::POST,
            endpoint: '/logins?orgId=' . $this->api->org_id,
            payload: $login_info
        );

        return $result === null ? null : new NewResourceUuid( $result );
    }
}
