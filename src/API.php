<?php

namespace GoSuccess\Enhance;

use GoSuccess\Enhance\Controllers\CustomerController;
use GoSuccess\Enhance\Controllers\LoginController;
use GoSuccess\Enhance\Controllers\MemberController;
use GoSuccess\Enhance\Controllers\OrganizationController;
use GoSuccess\Enhance\Controllers\PlanController;
use GoSuccess\Enhance\Controllers\StatusController;
use GoSuccess\Enhance\Controllers\SubscriptionController;
use GoSuccess\Enhance\Controllers\VersionController;
use GoSuccess\Enhance\Controllers\WebsiteController;
use GoSuccess\Enhance\Enumerations\HttpMethod;
use GoSuccess\Enhance\Models\Exception;
use stdClass;

class API
{
    private array $errors = [];

    public string $host;

    public string $org_id;

    public string $access_token;

    public VersionController $version;

    public StatusController $status;

    public OrganizationController $organization;

    public LoginController $login;

    public CustomerController $customer;

    public MemberController $member;

    public PlanController $plan;

    public SubscriptionController $subscription;

    public WebsiteController $website;

    public function __construct( string $host, string $org_id, string $access_token )
    {
        try
        {
            $this->host = $host;
            $this->org_id = $org_id;
            $this->access_token = $access_token;

            $this->version = new VersionController( $this );
            $this->status = new StatusController( $this );
            $this->organization = new OrganizationController( $this );
            $this->login = new LoginController( $this );
            $this->customer = new CustomerController( $this );
            $this->member = new MemberController( $this );
            $this->plan = new PlanController( $this );
            $this->subscription = new SubscriptionController( $this );
            $this->website = new WebsiteController( $this );
        }
        catch( Exception $e )
        {
            $this->errors[] = $e;
        }
    }

    public function set_host( string $host ): void
    {
        $this->host = $host;
    }

    public function set_org_id( string $org_id ): void
    {
        $this->org_id = $org_id;
    }

    public function set_access_token( string $access_token ): void
    {
        $this->access_token = $access_token;
    }

    public function request( HttpMethod $method, string $endpoint = '/version', object|string $payload = '', int $timeout = 30, bool $verify_ssl = false ): string|stdClass|bool|null
    {
        $response = null;

        try
        {
            $headers = [
                'Content-type: application/json',
                'Accept-Charset: utf-8',
                'Accept: application/json',
                'Authorization: Bearer ' . (string) $this->access_token
            ];

            $payload = json_encode( $payload );

            $request_url = (string) $this->host . $endpoint;

            $ch = curl_init();

            curl_setopt_array(
                $ch,
                [
                    CURLOPT_RETURNTRANSFER  => true,
                    CURLOPT_FOLLOWLOCATION  => false,
                    CURLOPT_ENCODING        => '',
                    CURLOPT_TIMEOUT         => $timeout,
                    CURLOPT_SSL_VERIFYPEER  => $verify_ssl,
                    CURLOPT_URL             => $request_url,
                    CURLOPT_CUSTOMREQUEST   => $method->value,
                    CURLOPT_HTTPHEADER      => $headers,
                    CURLOPT_POSTFIELDS      => $payload
                ]
            );

            $result = curl_exec( $ch );
            $http_code = curl_getinfo( $ch, CURLINFO_RESPONSE_CODE );

            curl_close( $ch );

            switch( $http_code )
            {
                case 400:
                    $this->errors[] = [
                        'status' => 'Invalid input',
                        'message' => $result
                    ];
                    break;

                case 401:
                    $this->errors[] = [
                        'status' => 'Invalid session',
                        'message' => $result
                    ];
                    break;

                case 403:
                    $this->errors[] = [
                        'status' => 'Insufficient privileges',
                        'message' => $result
                    ];
                    break;

                case 404:
                    $this->errors[] = [
                        'status' => 'Not found',
                        'message' => $result
                    ];
                    break;

                case 409:
                    $this->errors[] = [
                        'status' => 'Already exists',
                        'message' => $result
                    ];
                    break;

                default:
                    if ( empty( $result ) )
                    {
                        $response = true;
                    }
                    else
                    {
                        $json = json_decode( $result );
                        $response = $json === null ? str_replace( '"', '', $result ) : $json;
                    }
                    break;
            }
        }
        catch( Exception $e )
        {
            $this->errors[] = $e->getMessage();
            return null;
        }

        return $response;
    }

    public function get_errors(): array
    {
        return $this->errors;
    }

    public function get_last_error(): Exception
    {
        return end( $this->errors );
    }
}
