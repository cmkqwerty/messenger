<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'email'
    ];

    protected $guarded = [
        'password_hash'
    ];
}