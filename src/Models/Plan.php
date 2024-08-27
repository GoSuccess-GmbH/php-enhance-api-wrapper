<?php

namespace GoSuccess\Enhance\Models;

use DateTime;
use GoSuccess\Enhance\Abstracts\Model;
use GoSuccess\Enhance\Attributes\ArrayItemType;
use GoSuccess\Enhance\Enumerations\PhpVersion;
use GoSuccess\Enhance\Enumerations\PlanType;

class Plan extends Model
{
    public ?int $id = null;

    public ?string $name = null;

    public ?string $orgId = null;

    #[ArrayItemType(type: 'class', object: 'GoSuccess\Enhance\Models\Resource')]
    public ?array $resources = null;

    #[ArrayItemType(type: 'class', object: 'GoSuccess\Enhance\Models\Allowance')]
    public ?array $allowances = null;

    #[ArrayItemType(type: 'class', object: 'GoSuccess\Enhance\Models\Selection')]
    public ?array $selections = null;

    public ?int $subscriptionsCount = null;

    #[ArrayItemType(type: 'string')]
    public ?array $serverGroupIds = null;

    public ?bool $allowServerGroupSelection = null;

    public ?DateTime $createdAt = null;

    public ?PlanType $planType = null;

    public ?CgroupLimits $cgroupLimits = null;

    public ?FsQuotaLimit $fsQuotaLimit = null;

    #[ArrayItemType(type: 'enum', object: 'GoSuccess\Enhance\Enumerations\PhpVersion')]
    public ?array $allowedPhpVersions = null;

    public ?PhpVersion $defaultPhpVersion = null;

    public ?bool $redisAllowed = null;

    public ?string $preinstallWordpressTheme = null;
}
