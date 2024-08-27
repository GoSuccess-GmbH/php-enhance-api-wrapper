<?php

namespace GoSuccess\Enhance\Enumerations;

enum OrchdStatus: string
{
    case Initialising = 'initialising';
    
    case Updating = 'updating';
    
    case InitialisingServers = 'initialisingServers';
    
    case Ready = 'ready';
}