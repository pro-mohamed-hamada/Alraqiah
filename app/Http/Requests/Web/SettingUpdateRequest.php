<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
            'primary_phone'=>'required|numeric',
            'whatsapp_phone'=>'required|numeric',
            'email'=>'required|email',
            'about_us'=>'required|string',
            'terms_and_conditions'=>'required|string',
            'elhamla_male_doctor_number'=>'required|numeric',
            'elhamla_female_doctor_number'=>'required|numeric',
            'mufti_number'=>'required|numeric',
            'point_one_lat'=>'required|numeric',
            'point_one_lng'=>'required|numeric',
            'point_two_lat'=>'required|numeric',
            'point_two_lng'=>'required|numeric',
            'point_three_lat'=>'required|numeric',
            'point_three_lng'=>'required|numeric',
            'point_four_lat'=>'required|numeric',
            'point_four_lng'=>'required|numeric',
        ];
    }
}
