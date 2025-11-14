<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class UserSession extends Authenticatable
{
    use HasUuids;

    public $timestamps = true;
    public $incrementing = false;

    protected $table = 'user_session';
    protected $primaryKey = 'session_id';
    protected $keyType = 'string';
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->api_token = Str::random(128);
        });
    }
}
