<?php

namespace GoSuccess\Enhance\Models;
use GoSuccess\Enhance\Abstracts\Model;

class LoginInfo extends Model
{
    public ?string $email = null;

    public ?string $password = null;

    public ?string $name = null;
}
