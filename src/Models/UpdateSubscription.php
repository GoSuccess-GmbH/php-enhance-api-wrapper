<?php

namespace GoSuccess\Enhance\Models;

use GoSuccess\Enhance\Abstracts\Model;
use GoSuccess\Enhance\Enumerations\Status;

class UpdateSubscription extends Model
{
    public ?Status $status = null;

    public ?bool $isSuspended = null;

    public ?int $planId = null;

    public ?SubscriptionDedicatedServers $dedicatedServers = null;

    public ?string $friendlyName = null;
}
