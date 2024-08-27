<?php

namespace GoSuccess\Enhance\Models;
use GoSuccess\Enhance\Abstracts\Model;
use GoSuccess\Enhance\Attributes\ArrayItemType;
use GoSuccess\Enhance\Enumerations\PhpVersion;
use GoSuccess\Enhance\Enumerations\WebsiteStatus;

class UpdateWebsite extends Model
{
    public ?PhpVersion $phpVersion = null;

    public ?WebsiteStatus $status = null;

    public ?bool $isSuspended = null;

    #[ArrayItemType(type: 'int')]
    public ?array $tags = null;

    public ?int $subscriptionId = null;

    public ?string $orgId = null;
}
