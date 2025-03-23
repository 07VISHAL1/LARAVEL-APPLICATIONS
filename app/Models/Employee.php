<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Employee extends Model
{
    use softDeletes;
    protected $fillable = [
        'user_id',
        'phone_no',
        'date_of_birth',
        'date_of_birth',
        'date_of_joining',
        'tax_regime',
        'emrgency_phone_no',
        'employee_code',   
    ];
}
