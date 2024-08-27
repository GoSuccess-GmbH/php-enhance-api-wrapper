<?php

namespace GoSuccess\Enhance\Controllers;
use GoSuccess\Enhance\Abstracts\Controller;
use GoSuccess\Enhance\Enumerations\HttpMethod;
use GoSuccess\Enhance\Models\UpdateSubscription;

class SubscriptionController extends Controller
{
    /**
     * Updates the organization's subscription. This endpoint is used to update
     * the subscription's status and suspension, by a parent organization admin.
     * 
     * @link: https://apidocs.enhance.com/#/subscriptions/updateSubscription
     * @param int $subscription_id
     * @param \GoSuccess\Enhance\Models\UpdateSubscription $subscription
     * @return bool|string|\stdClass|null
     */
    public function update_subscription( int $subscription_id, UpdateSubscription $subscription ): ?bool
    {
        $result = $this->api->request(
            method: HttpMethod::PATCH,
            endpoint: '/orgs/' . $this->api->org_id . '/subscriptions/' . $subscription_id,
            payload: $subscription
        );

        return $result;
    }
    
    /**
     * Soft or force deletes the subscription and its resources. All resources under the
     * subscription (websites, customers in case of a reseller) will be deleted too. If
     * the subscription is soft-deleted (or marked as deleted), its data is not removed.
     * For removing all data and metadata, pass the force=true query parameter. This can
     * only be done by a privileged MO member. In this case, all data is wiped, so use
     * carefully. If the force parameter is set, session holder must be an MO Owner,
     * SuperAdmin, or Support member, otherwise it suffices for them to be such a member
     * in a parent org.
     * 
     * @link https://apidocs.enhance.com/#/subscriptions/deleteSubscription
     * @param int $subscription_id
     * @param bool $force
     * @return bool|string|\stdClass|null
     */
    public function delete_subscription( int $subscription_id, bool $force = false ): ?bool
    {
        $query = $force ? (string) '?force=' . $force : '';

        $result = $this->api->request(
            method: HttpMethod::DELETE,
            endpoint: '/orgs/' . $this->api->org_id . '/subscriptions/' . $subscription_id . $query,
        );

        return $result;
    }
}
