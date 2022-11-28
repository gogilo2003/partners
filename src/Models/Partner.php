<?php

namespace Ogilo\Partners\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory;

    public function getLogoAttribute($value)
    {
        return asset($value);
    }
}
