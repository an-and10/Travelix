<?php

namespace App\Models;

use App\Models\PackageImage;
use Illuminate\Database\Eloquent\Model;

class package extends Model
{
    protected $guarded= [];

    public function packageImages()
    {
        return $this->hasMany(PackageImage::class);
    }

}
