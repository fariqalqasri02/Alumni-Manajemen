<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'nim' => ['nullable', 'string', 'max:50', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'user_type' => ['nullable', 'in:mahasiswa,alumni'],
            'address' => ['nullable', 'string'],
            'graduation_year' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'study_program' => ['nullable', 'string', 'max:255'],
            'education_history' => ['nullable', 'string'],
            'skills' => ['nullable', 'string'],
            'work_experience' => ['nullable', 'string'],
            'current_company' => ['nullable', 'string', 'max:255'],
            'current_position' => ['nullable', 'string', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
        ];
    }
}
