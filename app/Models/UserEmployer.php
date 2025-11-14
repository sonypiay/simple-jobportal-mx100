<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class UserEmployer extends Model
{
    use HasUuids;

    public $timestamps = true;
    public $incrementing = false;

    protected $table = 'user_employer';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = [];
    protected $hidden = [
        'password'
    ];
}
