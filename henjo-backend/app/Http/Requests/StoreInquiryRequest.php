<?php

namespace App\Http\Requests;

use App\Support\Sanitizer;
use App\Support\ValidationPatterns;
use Illuminate\Foundation\Http\FormRequest;

class StoreInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => Sanitizer::clean($this->input('name')),
            'email' => Sanitizer::clean($this->input('email')),
            // Empty string -> null so the `nullable` rule actually skips the
            // phone regex instead of failing it on a blank optional field.
            'phone' => Sanitizer::clean($this->input('phone')) ?: null,
            'subject' => Sanitizer::clean($this->input('subject')),
            'message' => Sanitizer::clean($this->input('message')),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:'.ValidationPatterns::NAME],
            'email' => ['required', 'email', 'max:255', 'regex:'.ValidationPatterns::EMAIL],
            'phone' => ['nullable', 'string', 'max:50', 'regex:'.ValidationPatterns::PHONE],
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
            'package_id' => 'nullable|integer|exists:safari_packages,id',
        ];
    }
}
