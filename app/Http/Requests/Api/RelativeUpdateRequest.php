<?php

namespace App\Http\Requests\Api;

use App\Enum\ActivationStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RelativeUpdateRequest extends FormRequest
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
            'chronic_disease'=>'required|integer|in:'.ActivationStatusEnum::ACTIVE.','.ActivationStatusEnum::NOT_ACTIVE,
            'chronic_disease_description'=>'nullable|string|required_if:chronic_disease,'.ActivationStatusEnum::ACTIVE,
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if($this->chronic_disease == ActivationStatusEnum::NOT_ACTIVE)
            $this->merge([
                'chronic_disease_description' => "",
            ]);
    }
}
