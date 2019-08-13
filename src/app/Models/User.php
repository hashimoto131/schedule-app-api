<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'login_id',
        'password',
    ];

    protected $visible = [
        'name',
        'login_id',
        'created_at',
        'updated_at',
    ];
}
