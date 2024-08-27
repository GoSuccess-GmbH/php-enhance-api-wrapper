<?php

namespace GoSuccess\Enhance\Models;
use GoSuccess\Enhance\Abstracts\Model;

class NewSubscription extends Model
{
    public ?int $planId = null;

    public ?SubscriptionDedicatedServers $dedicatedServers = null;

    public ?string $friendlyName = null;
}
