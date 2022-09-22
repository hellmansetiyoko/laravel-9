<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBiodataRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nik' => 'required',
            'dob' => 'required|date|before:now',
            'city_of_birth' => 'required',
            'address' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'dob' => 'date of birth',
            'city_of_birth' => 'city of birth',
        ];
    }
}
