<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class JobListingsTag extends Model
{
    use HasUuids;

    public $timestamps = false;
    public $incrementing = false;

    protected $table = 'job_listings_tag';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = [];
}
