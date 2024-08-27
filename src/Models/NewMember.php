<?php

namespace GoSuccess\Enhance\Models;
use GoSuccess\Enhance\Abstracts\Model;
use GoSuccess\Enhance\Attributes\ArrayItemType;

class NewMember extends Model
{
    public ?string $loginId = null;

    #[ArrayItemType(type: 'enum', object: 'GoSuccess\Enhance\Enumerations\Role')]
    public ?array $roles = null;
}
