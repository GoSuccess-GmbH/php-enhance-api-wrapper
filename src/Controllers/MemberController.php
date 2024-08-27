<?php

namespace GoSuccess\Enhance\Controllers;

use GoSuccess\Enhance\Abstracts\Controller;
use GoSuccess\Enhance\Enumerations\HttpMethod;
use GoSuccess\Enhance\Models\NewMember;
use GoSuccess\Enhance\Models\NewResourceUuid;

class MemberController extends Controller
{
    /**
     * Create organization member. A login for the member needs to exist before
     * establishing membership. On success, the member id is returned. This
     * operation can only be done by a logged in superadmin or owner of the
     * organization or its parent organization(s).
     * 
     * @link https://apidocs.enhance.com/#/members/createMember
     * @param \GoSuccess\Enhance\Models\NewMember $member
     * @return NewResourceUuid|null
     */
    public function create_member( NewMember $member ): ?NewResourceUuid
    {
        $result = $this->api->request(
            method: HttpMethod::POST,
            endpoint: '/orgs/' . $this->api->org_id . '/members',
            payload: $member
        );

        return $result === null ? null : new NewResourceUuid( $result );
    }
}
