<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'type',
        'starting_date',
        'ending_date',
        'reason_for_leave',
        'status',
        'email',

    ];
}
