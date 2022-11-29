<?php

namespace Ogilo\Partners\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnerRequest extends FormRequest
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
        return [
            "id" => "required|integer|exists:partners",
            "name" => "required|unique:partners,name," . $this->id,
            "email" => "nullable|email|unique:partners,email," . $this->id,
            "phone" => "nullable|min:9|unique:partners,phone," . $this->id,
            "website" => "nullable|url|unique:partners,website," . $this->id,
            // "socialmedia" => "nullable|array:name,url",
            "socialmedia.*.name" => "required|distinct",
            "socialmedia.*.url" => "required|distinct|url",
        ];
    }
}
