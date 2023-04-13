<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShortLinkRequest extends FormRequest
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
            'url' => 'required|url',
            'name' => 'required|string',
            'expired_date' => 'required|string',
        ];
    }

    public function messages() {

        return [
            'url.required'=> 'The :attribute is required',
            'url.url'=> 'The :attribute is not url',
            'name.required'=> 'The :attribute is required',
            'expired_date.required'=> 'The :attribute is required',
            'name.string'=> 'The :attribute is not valid name',
            'expired_date.string'=> 'The :attribute is not valid expired_date'
        ];
    }
}
