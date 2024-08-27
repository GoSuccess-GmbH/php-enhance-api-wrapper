<?php

namespace GoSuccess\Enhance\Enumerations;

enum WebsiteStatus: string
{
    case Active = 'active';

    case Disabled = 'disabled';

    case Deleted = 'deleted';
}
