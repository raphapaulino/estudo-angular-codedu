<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Facade;

class SectionGuardFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SectionGuardManager::class;
    }

}