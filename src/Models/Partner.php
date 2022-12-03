<?php

namespace Ogilo\Partners\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Partner extends Model
{
    public function getLogoAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }
}
