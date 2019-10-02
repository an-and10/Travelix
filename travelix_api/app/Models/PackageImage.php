<?php

namespace App\Models;

use App\Models\Package;
use Illuminate\Database\Eloquent\Model;

class PackageImage extends Model
{
    protected $guarded = [];

    public function packages()
    {
        return $this->belongsTo(Package::class);
    }
}
