<?php

namespace App\Http\Requests\Web;

use App\Enum\ClientStatusEnum;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
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
        $client = Client::find($this->client);
        return [
            'name'=>'required|string',
            'phone'=>'required|string|unique:users,phone,'.$client->user->id,
            'is_active'=>'nullable|string',
            'reservation_number'=>'required|integer',
            'reservation_status'=>'required|string',
            'package'=>'required|string',
            'launch_date'=>'required|date|after_or_equal:'.Carbon::now(),
            'seat_number'=>'required|string',
            'gender'=>'required|string',
            'national_number'=>'required|string',
            'city'=>'required|string',
            'supervisor_id'=>'required|integer|exists:users,id',
            'relatives_name'=>'nullable|array',
            'relatives_name.*'=>'required|string',
            'relatives_gender'=>'nullable|array',
            'relatives_gender.*'=>'required|string',
            'relatives_national_number'=>'nullable|array',
            'relatives_national_number.*'=>'required|string',
            'relatives_seat_number'=>'nullable|array',
            'relatives_seat_number.*'=>'required|string',
            'relatives_city'=>'nullable|array',
            'relatives_city.*'=>'required|string',
        ];
    }
}
