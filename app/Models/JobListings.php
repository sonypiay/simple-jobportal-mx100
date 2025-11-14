<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class JobListings extends Model
{
    use HasUuids;

    public $timestamps = true;
    public $incrementing = false;

    protected $table = 'job_listings';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = [];
}
