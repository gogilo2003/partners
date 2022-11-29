<?php

namespace Ogilo\Partners\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public function getLogoAttribute($value)
    {
        return $value ? asset($value) : null;
    }
}
