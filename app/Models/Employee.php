<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = [
        'photo','name','email','gender','birth_date','join_date',
        'phone','address','salary','account_number','bank_name',
        'user_id','depart_id'

    ];
}
