<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public $timestamps = ['created_at'];

    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'expires_at'
    ];

    protected $guarded = [
        'refresh_token'
    ];

    protected $dates = [
        'expires_at'
    ];

    // relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function findByRefreshToken($refreshToken)
    {
        return self::where('refresh_token', $refreshToken)->first();
    }

    public function isExpired()
    {
        return Carbon::now()->gt($this->expires_at);
    }
}