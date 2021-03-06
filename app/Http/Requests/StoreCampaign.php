<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaign extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:6|unique:campaigns,name' . ($this->campaign ? ',' . $this->campaign->id : null),
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:8192',
            'locale' => 'string',
        ];
    }
}
