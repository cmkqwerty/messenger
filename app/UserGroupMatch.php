<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroupMatch extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'group_id'
    ];

    protected $guarded = [];

    // relationships
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}