<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps = ['created_at'];

    const UPDATED_AT = null;

    protected $fillable = [
        'group_id',
        'user_id',
        'content'
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