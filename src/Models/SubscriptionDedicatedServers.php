<?php

namespace GoSuccess\Enhance\Models;
use GoSuccess\Enhance\Abstracts\Model;

class SubscriptionDedicatedServers extends Model
{
    public ?string $appServerId = null;
    
    public ?string $backupServerId = null;
    
    public ?string $dbServerId = null;
    
    public ?string $emailServerId = null;
}
