<?php

namespace GoSuccess\Enhance\Controllers;
use GoSuccess\Enhance\Abstracts\Controller;
use GoSuccess\Enhance\Enumerations\HttpMethod;
use GoSuccess\Enhance\Models\NewResourceUuid;
use GoSuccess\Enhance\Models\NewWebsite;
use GoSuccess\Enhance\Models\UpdateWebsite;
use GoSuccess\Enhance\Models\UuidListing;

class WebsiteController extends Controller
{
    /**
     * Creates or clones a website under the organization. If the org is the MO,
     * the request need not contain a subscription ID, but if it's a customer and
     * the session holder is not an MO admin, the subscription to which to attach
     * the website must be supplied. If the website to be created is 'staging' kind
     * then the subscription must include stagingWebsites resource > 1. If 'normal'
     * then the subscription must include websites > 1. If the website to be created
     * is a control panel, the reseller's subscription id must match the reseller
     * subscription. Session holder must be at least a SuperAdmin in this org or a
     * parent org.
     * 
     * @link https://apidocs.enhance.com/#/websites/createWebsite
     * @param \GoSuccess\Enhance\Models\NewWebsite $website
     * @param string $kind  normal, controlPanel, phpMyAdmin, roundcube, staging, serverHostname
     * @return NewResourceUuid|null
     */
    public function create_website( NewWebsite $website, string $kind = 'normal' ): ?NewResourceUuid
    {
        $result = $this->api->request(
            method: HttpMethod::POST,
            endpoint: '/orgs/' . $this->api->org_id . '/websites?kind=' . $kind,
            payload: $website
        );

        return $result === null ? null : new NewResourceUuid( $result );
    }
    
    /**
     * Delete websites. This operation can only be done by a logged in superadmin or
     * owner of the organization or its parent organization(s).
     * 
     * @link https://apidocs.enhance.com/#/websites/deleteWebsites
     * @param \GoSuccess\Enhance\Models\UuidListing $website_ids
     * @return bool|string|\stdClass|null
     */
    public function delete_website( UuidListing $website_ids ): ?bool
    {
        $result = $this->api->request(
            method: HttpMethod::DELETE,
            endpoint: '/orgs/' . $this->api->org_id . '/websites',
            payload: $website_ids
        );

        return $result;
    }
    
    /**
     * Updates the website. It may be used to enable or disable a specific version of PHP
     * for a website, in which case a corresponding PhpCd instance is installed or uninstalled
     * on the same server of the website. When enabling the website PHP it is also possible to
     * specify whether the SSH daemon will need to be enabled in the PhpCd service at startup,
     * via the ssh boolean flag. Moreover, if PHP is already enabled for a website, it is possible
     * to enable or disable its SSH by only specifying the ssh flag. The endpoint is also responsible
     * for assigning tags to a website. Note that the input overwrites all existing tags, so when
     * adding a new tag, the tags property also has to include existing tags that are to be kept.
     * Only a parent organization or MO admin may suspend websites. The website may be moved to
     * another subscription, if that subscription has enough quota to accommodate the new website,
     * unless the MO is performing the action, in which case they may move any website off a
     * subscription or to a subscription that doesn't necessary have quota left. Session holder must
     * be at least a SuperAdmin in this org or a parent org.
     * 
     * @link https://apidocs.enhance.com/#/websites/updateWebsite
     * @param \GoSuccess\Enhance\Models\UpdateWebsite $update_website
     * @param string $website_id
     * @return bool|string|\stdClass|null
     */
    public function update_website( UpdateWebsite $update_website, string $website_id ): ?bool
    {
        $result = $this->api->request(
            method: HttpMethod::PATCH,
            endpoint: '/orgs/' . $this->api->org_id . '/websites/' . $website_id,
            payload: $update_website
        );

        return $result;
    }
}
