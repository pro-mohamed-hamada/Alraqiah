<?php

namespace App\Http\Requests\Web;

use Carbon\Carbon;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
            'name'=>'required|string',
            'phone'=>'required|string|unique:users,phone',
            'is_active'=>'nullable|string',
            'reservation_number'=>'required|integer',
            'package'=>'required|string',
            'launch_date'=>'required|date|after_or_equal:'.Carbon::now(),
            'seat_number'=>'required|string',
            'gender'=>'required|string',
            'identity_number'=>'required|string',
            'country'=>'required|string',
            'city'=>'required|string',
            'supervisor_id'=>'required|integer|exists:users,id',
            'relatives_name'=>'nullable|array',
            'relatives_name.*'=>'required|string',
            'relatives_gender'=>'nullable|array',
            'relatives_gender.*'=>'required|string',
            'relatives_identity_number'=>'nullable|array',
            'relatives_identity_numberer.*'=>'required|string',
            'relatives_seat_number'=>'nullable|array',
            'relatives_seat_number.*'=>'required|string',
            'relatives_country'=>'nullable|array',
            'relatives_country.*'=>'required|string',
            'relatives_city'=>'nullable|array',
            'relatives_city.*'=>'required|string',
            'sites'=>'nullable|array',
            'sites.*'=>'required|integer|exists:sites,id',
            'chronic_disease'=>'nullable|string',
            'chronic_disease_discription'=>'nullable|required_with:chronic_disease|string',
            'relatives_chronic_disease'=>'nullable|array',
            'relatives_chronic_disease.*'=>'nullable|string',
            'relatives_chronic_disease_discription'=>'nullable|array',
            'relatives_chronic_disease_discription.*'=>'nullable|string|required_with:relatives_chronic_disease.*',
        ];
    }
}
