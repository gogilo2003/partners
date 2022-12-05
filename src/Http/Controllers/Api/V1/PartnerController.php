<?php

namespace Ogilo\Partners\Http\Controllers\Api\V1;

use Ogilo\Partners\Models\Partner;
use Ogilo\Partners\Http\Resources\V1\PartnerResource;
use Ogilo\Partners\Http\Controllers\Api\ApiController;
use Ogilo\Partners\Http\Requests\V1\StorePartnerRequest;
use Ogilo\Partners\Http\Requests\V1\DeletePartnerRequest;
use Ogilo\Partners\Http\Requests\V1\UpdatePartnerRequest;
use Ogilo\Partners\Http\Requests\V1\StorePartnerLogoRequest;

class PartnerController extends ApiController
{
    public function index()
    {
        return PartnerResource::collection(Partner::all());
    }

    public function store(StorePartnerRequest $request)
    {
        $partner = new Partner();

        $partner->name = $request->name;
        $partner->phone = $request->phone;
        $partner->email = $request->email;
        $partner->website = $request->website;
        $partner->socialmedia = json_encode($request->socialmedia);

        $partner->save();
        return $this->storeSuccess("Partner stored", ['partner' => PartnerResource::make($partner)]);
    }

    public function update(UpdatePartnerRequest $request)
    {
        $partner = Partner::find($request->id);

        $partner->name = $request->name;
        $partner->phone = $request->phone ?? $partner->phone;
        $partner->email = $request->email ?? $partner->email;
        $partner->website = $request->website ?? $partner->website;
        $partner->socialmedia = $request->socialmedia
            ? json_encode($request->socialmedia)
            : $partner->socialmedia;

        $partner->save();
        return $this->updateSuccess("Partner updated", ['partner' => PartnerResource::make($partner)]);
    }

    public function logo(StorePartnerLogoRequest $request)
    {
        $partner = Partner::find($request->id);

        $partner->logo = $request->logo->store('public/partners/logos');

        $partner->save();

        return response()->json(["message" => "Logo uploaded", 'id' => $partner->id, 'logo' => $partner->logo]);
    }

    public function publish(DeletePartnerRequest $request)
    {
        $partner = Partner::find($request->id);

        $partner->published = $partner->published ? 0 : 1;

        $partner->save();

        return response()->json(
            [
                "message" => "Partners has been " . ($partner->published ? "published" : "unpublished"),
                'id' => $partner->id,
                'published' => $partner->published
            ]
        );
    }

    public function delete(DeletePartnerRequest $request)
    {
        Partner::destroy($request->id);
        return $this->deleteSuccess();
    }
}
