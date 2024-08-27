<?php

namespace GoSuccess\Enhance\Models;
use GoSuccess\Enhance\Abstracts\Model;
use GoSuccess\Enhance\Enumerations\PhpVersion;

class NewWebsite extends Model
{
    public ?string $domain = null;

    public ?int $subscriptionId = null;

    public ?string $appServerId = null;

    public ?string $backupServerId = null;

    public ?string $dbServerId = null;

    public ?string $emailServerId = null;

    public ?string $serverGroupId = null;

    public ?PhpVersion $phpVersion = null;
}
