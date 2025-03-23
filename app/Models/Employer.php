<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Employer extends Model
{
    protected $fillable = [
        'user_id',
        'phone_no',
        'address',
        'gstin_no',
        'company_name',  
    ];
}
