<?php

namespace GoSuccess\Enhance\Enumerations;

enum Role: string
{
    case Owner = 'Owner';

    case SuperAdmin = 'SuperAdmin';
    
    case Business = 'Business';
    
    case SiteAccess = 'SiteAccess';
    
    case Support = 'Support';
    
    case Sysadmin = 'Sysadmin';
}
