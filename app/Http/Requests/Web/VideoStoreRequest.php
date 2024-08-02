<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VideoStoreRequest extends FormRequest
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
            'title'=>'required|string',
            'type'=>'required|string|in:video,image',
            'media_file'=>['required','file',
                Rule::when($this->type === 'video', ['mimes:mp4,mkv,avi,mov,mpeg']),
                Rule::when($this->type === 'image', ['mimes:jpg,jpeg,png,webp']),
            ],
            'is_active'=>'nullable|string',
        ];
    }
}
