<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentEditRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required|min:10',
            'price' => 'required|numeric',
            'rooms_number' => 'required|numeric',
            'guests_number' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'area_sm' => 'required|numeric',
            'address' => 'required',
            'address_lat' => 'required|numeric',
            'address_lon' => 'required|numeric',
            'visibility' => 'required|numeric|min:0|max:1',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
