<?php

namespace GoSuccess\Enhance\Abstracts;

use GoSuccess\Enhance\API;

class Controller
{
    protected API $api;

    public function __construct( API $api )
    {
        $this->api = $api;
    }
}
