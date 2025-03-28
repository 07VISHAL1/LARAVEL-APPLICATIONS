<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class EmployeeListFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'App\Services\EmployeeListService'; }
}