<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "site_title" => "required|string|max:250",
            "site_address" => "required|string|max:250",
            "site_phone" => "required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10",
            "site_facebook_link" => "required|string|max:250",
            "site_instagram_link" => "nullable|string|max:250",
            "site_linkedin_link" => "nullable|string|max:250",
            "site_youtube_link" => "nullable|string|max:250",
            "site_description" => "nullable|string|max:250",
        ];
    }
}
