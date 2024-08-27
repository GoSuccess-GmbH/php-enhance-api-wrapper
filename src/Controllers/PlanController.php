<?php

namespace GoSuccess\Enhance\Controllers;
use GoSuccess\Enhance\Abstracts\Controller;
use GoSuccess\Enhance\Enumerations\HttpMethod;
use GoSuccess\Enhance\Models\PlansListing;

class PlanController extends Controller
{
    /**
     * Returns the organization's plans, optionally filtered by query parameters.
     * Note that the endpoint does not require authentication as anyone should be
     * able to view an organization's plans on offer so that the viewer may decide
     * to subscribe to a plan.
     * 
     * @param int $offset
     * @param int $limit
     * @param mixed $sort_by    name
     * @param mixed $sort_order asc, desc
     * @return PlansListing|null
     */
    public function list_plans( int $offset = 0, int $limit = 0, ?string $sort_by = null, ?string $sort_order = null ): ?PlansListing
    {
        $query = [];

        if ( $offset > 0 )
        {
            $query['offset'] = $offset;
        }

        if ( $limit > 0 )
        {
            $query['limit'] = $limit;
        }

        if ( $sort_by !== null )
        {
            $query['sort_by'] = $sort_by;
        }

        if ( $sort_order !== null )
        {
            $query['sort_order'] = $sort_order;
        }

        $query = empty( $query ) ? '' : '?' . http_build_query( $query );

        $result = $this->api->request(
            method: HttpMethod::GET,
            endpoint: '/orgs/' . $this->api->org_id . '/plans' . $query
        );

        return $result === null ? null : new PlansListing( $result );
    }
}
