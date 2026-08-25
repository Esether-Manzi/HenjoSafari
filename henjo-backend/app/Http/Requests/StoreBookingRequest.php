<?php

namespace App\Http\Requests;

use App\Support\Sanitizer;
use App\Support\ValidationPatterns;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'first_name' => Sanitizer::clean($this->input('first_name')),
            'last_name' => Sanitizer::clean($this->input('last_name')),
            'email' => Sanitizer::clean($this->input('email')),
            'phone' => Sanitizer::clean($this->input('phone')),
            'country' => Sanitizer::clean($this->input('country')),
            'package_name' => Sanitizer::clean($this->input('package_name')),
            'special_requests' => Sanitizer::clean($this->input('special_requests')),
        ]);
    }

    public function rules(): array
    {
        return [
            // Personal information
            'first_name' => ['required', 'string', 'max:100', 'regex:'.ValidationPatterns::NAME],
            'last_name' => ['required', 'string', 'max:100', 'regex:'.ValidationPatterns::NAME],
            'email' => ['required', 'email', 'max:255', 'regex:'.ValidationPatterns::EMAIL],
            'phone' => ['required', 'string', 'max:50', 'regex:'.ValidationPatterns::PHONE],
            'country' => 'required|string|max:100',

            // Trip details
            'package_id' => 'nullable|integer|exists:safari_packages,id',
            'package_name' => 'nullable|string|max:255',
            'travel_date' => 'required|date|after:today',
            'adults' => 'required|integer|min:1|max:50',
            'children' => 'nullable|integer|min:0|max:50',
            'special_requests' => 'nullable|string|max:2000',
        ];
    }
}
