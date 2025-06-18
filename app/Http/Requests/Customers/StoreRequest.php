<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'min:3', 'max:255'],
            'last_name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:customers,email'],
            'phone' => ['required', 'unique:customers,phone', 'regex:/^\+?[1-9]\d{6,14}$/'],
            'company_name' => ['required', 'min:3', 'max:255', 'unique:companies,name'],
            'country_code' => ['required', 'max:255'],
            'logo' => ['nullable', 'image', 'max:5120', 'mimetypes:image/jpeg,image/png,image/webp'],
        ];
    }
}
