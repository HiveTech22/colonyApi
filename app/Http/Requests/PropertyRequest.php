<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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

    public function rules()
    {
        return [
            'title'                             => ['required', 'max:50'],
            'price'                             => ['required'],
            'purpose'                           => ['required'],
            'frequency'                         => ['required'],
            'built'                             => ['required'],
            'address'                           => ['required'],
            'description'                       => ['required'],
            'agreement'                         => ['required'],
            'image'                             => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'image2'                            => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'image3'                            => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'video'                             => ['nullable'],
        ];
    }


    // public function messages() {

    //     'agreement.required' => 'You need to agree to our terms of creating this property!',
    // }
}