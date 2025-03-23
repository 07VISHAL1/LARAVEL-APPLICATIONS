<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    
    protected $fillable =
     [
        'employee_id',
        'year',
        'amount',
        'role_id',
    ];
}