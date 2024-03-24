<?php

namespace App\Http\Requests\Web;

use Carbon\Carbon;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class ImportClientRequest extends FormRequest
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
            'file'=>'required|file|mimes:xls,xlsx',
            'supervisor_id'=>'required|integer|exists:users,id',
        ];
    }
}
