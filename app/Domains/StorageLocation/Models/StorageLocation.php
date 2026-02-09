<?php

namespace App\Domains\StorageLocation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StorageLocation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];
}
