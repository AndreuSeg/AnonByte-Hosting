<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stack extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stack_name',
        'mysql_database',
        'mysql_user',
        'mysql_password',
        'mysql_root_password',
    ];

    protected $hidden = [
        'mysql_database',
        'mysql_user',
        'mysql_password',
        'mysql_root_password',
    ];
}
