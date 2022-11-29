<?php

namespace Ogilo\Partners\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // $phoneUtil = PhoneNumberUtil::getInstance();
        $this->merge(['phone', \Illuminate\Support\Str::replace("0", "+254", $this->phone)]);

        return [
            "name" => "required|unique:partners",
            "email" => "nullable|email|unique:partners",
            "phone" => "nullable|min:9|unique:partners",
            "website" => "nullable|url|unique:partners",
            // "socialmedia" => "array:name,url",
            "socialmedia.*.name" => "required|distinct",
            "socialmedia.*.url" => "required|distinct|url",
        ];
    }
}
