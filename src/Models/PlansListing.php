<?php

namespace GoSuccess\Enhance\Models;

use GoSuccess\Enhance\Abstracts\Model;
use GoSuccess\Enhance\Attributes\ArrayItemType;

class PlansListing extends Model
{
    #[ArrayItemType(type: 'class', object: 'GoSuccess\Enhance\Models\Plan')]
    public ?array $items = null;

    public ?int $total = null;
}
