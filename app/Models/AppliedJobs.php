<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class AppliedJobs extends Model
{
    use HasUuids;

    public $timestamps = true;
    public $incrementing = false;

    protected $table = 'applied_jobs';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = [];
}
