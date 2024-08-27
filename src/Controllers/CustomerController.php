<?php

namespace GoSuccess\Enhance\Controllers;
use GoSuccess\Enhance\Abstracts\Controller;
use GoSuccess\Enhance\Enumerations\HttpMethod;
use GoSuccess\Enhance\Models\NewCustomer;
use GoSuccess\Enhance\Models\NewResourceId;
use GoSuccess\Enhance\Models\NewResourceUuid;
use GoSuccess\Enhance\Models\NewSubscription;

class CustomerController extends Controller
{
    /**
     * Create a customer organization. Once customer is successfully created under parent
     * organization (identified by org_id), the customer organization's id is returned.
     * This operation can only be done by a logged in superadmin or owner of the organization
     * or its parent organization(s).
     * 
     * @link https://apidocs.enhance.com/#/orgs/createCustomer
     * @param \GoSuccess\Enhance\Models\NewCustomer $customer
     * @return NewResourceUuid|null
     */
    public function create_customer( NewCustomer $customer ): ?NewResourceUuid
    {
        $result = $this->api->request(
            method: HttpMethod::POST,
            endpoint: '/orgs/' . $this->api->org_id . '/customers',
            payload: $customer
        );

        return $result === null ? null : new NewResourceUuid( $result );
    }

    /**
     * Creates a subscription for customer to the org's plan. Only a reseller org or the MO may
     * subscribe another org to one of its plans. If the organization is a reseller (and thus not
     * the MO), it needs to have a suitable subscription to a reseller plan of its parent. It is
     * verified that the reseller's reseller subscription has quota left to create the new subscription
     * (because the new subscription draws from the reseller's reseller subscription). After this
     * call, the sold resources are recorded in the reseller subscription by increasing each sold
     * resource's usage by the sold amount. In combination with the quota check, this is how it is
     * ensured that the reseller doesn't sell more resources than it has paid for. The MO may optionally
     * override the package default servers or server group. All resources of this subscription will
     * then be created on those servers. Otherwise the subscribed to plan's servers are used, or if
     * those aren't defined either, the usual website placement rules are used every time a website
     * is created under this subscription. Session holder must be at least a SuperAdmin in this org
     * or a parent org, or be a member in this org that has access to the website.
     * 
     * @link https://apidocs.enhance.com/#/customers/createCustomerSubscription
     * @param string $customer_org_id
     * @param \GoSuccess\Enhance\Models\NewSubscription $subscription
     * @return NewResourceId|null
     */
    public function create_subscription( string $customer_org_id, NewSubscription $subscription ): ?NewResourceId
    {
        $result = $this->api->request(
            method: HttpMethod::POST,
            endpoint: '/orgs/' . $this->api->org_id . '/customers/' . $customer_org_id . '/subscriptions',
            payload: $subscription
        );

        return $result === null ? null : new NewResourceId( $result );
    }
}
