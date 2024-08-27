<?php

namespace GoSuccess\Enhance\Models;
use GoSuccess\Enhance\Abstracts\Model;
use GoSuccess\Enhance\Attributes\ArrayItemType;

class UuidListing extends Model
{
    #[ArrayItemType(type: 'string')]
    public ?array $ids = null;
}
