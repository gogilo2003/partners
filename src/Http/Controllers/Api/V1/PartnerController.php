<?php

namespace Ogilo\Partners\Http\Controllers\Api\V1;

use Ogilo\Partners\Models\Partner;
use Ogilo\Partners\Http\Resources\V1\PartnerResource;
use Ogilo\Partners\Http\Controllers\Api\ApiController;

class PartnerController extends ApiController
{
    public function index()
    {
        return PartnerResource::collection(Partner::all());
    }
}
