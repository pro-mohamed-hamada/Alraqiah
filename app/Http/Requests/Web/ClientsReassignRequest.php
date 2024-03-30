<?php

namespace App\Http\Requests\Web;

use App\Enum\ClientStatusEnum;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ClientsReassignRequest extends FormRequest
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
            'supervisor_id'=>'required|integer|exists:users,id',
        ];
    }
}
