<?php

namespace App\Http\Requests\Web;

use App\Enum\ActivationStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email'=>'required|email',
            'password'=>'required|string|min:8|confirmed',
            'phone'=>'required|string|unique:users,phone,'.$this->user,
            'logo'=>'nullable|file|image',
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'string|exists:permissions,name',
            'is_active'=>'nullable|string',
            'whatsapp_url'=>'nullable|url',
        ];
    }
}
