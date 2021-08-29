<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'name' => 'required|max:50',
            'phone' => 'nullable|max:20',
            'email' => 'nullable|max:40',
            'zip_code' => 'nullable|max:9',
            'addr_number' => 'nullable|max:10',
            'address' => 'nullable|max:100',
            'complement' => 'nullable|max:50',
            'uf' => 'nullable|max:2',
            'district' => 'nullable|max:50',
            'city' => 'nullable|max:50',
            'img_name' => 'nullable',
            'img_path' => 'nullable',
        ];
    }
}
