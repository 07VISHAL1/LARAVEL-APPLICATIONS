<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class AdminFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'App\Services\AdminService'; }
}
