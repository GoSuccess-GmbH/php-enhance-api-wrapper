<?php

namespace GoSuccess\Enhance\Models;
use GoSuccess\Enhance\Abstracts\Model;

class CgroupLimits extends Model
{
    public ?int $nproc = null;

    public ?int $memoryLimit = null;

    public ?int $iops = null;

    public ?int $ioBandwidth = null;

    public ?float $virtualCpus = null;
}
