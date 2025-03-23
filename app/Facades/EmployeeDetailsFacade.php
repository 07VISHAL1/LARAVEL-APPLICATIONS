<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class EmployeeDetailsFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'App\Services\EmployeeDetailsService'; }
}
