<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AccreditationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Base rules that apply to all types
        $rules = [
            'type_owner' => ['required', 'integer', 'in:0,1,2'],
            'fio' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'region' => ['required', 'integer', 'exists:regions,id'],
            'address' => ['required', 'string', 'max:255'],
            'documents' => ['required', 'array', 'min:1', 'max:5'],
            'documents.*' => ['file', 'mimes:pdf,png,jpg,jpeg,webp', 'max:10240'] // Max 10MB per file
        ];

        // Add validation rules based on owner type
        switch (request()->input('type_owner')) {
            case 0: // Individual
                $rules['email'] = ['required', 'string', 'email', 'max:255'];
                $rules['passport_series'] = ['required', 'string', 'max:10'];
                $rules['passport_number'] = ['required', 'string', 'max:20'];
                $rules['passport_issued_by'] = ['required', 'string', 'max:255'];
                $rules['passport_issued_date'] = ['required', 'date'];
                break;
                
            case 1: // Sole Proprietor (ИП)
                $rules['unp'] = ['required', 'string', 'max:50'];
                break;
                
            case 2: // Company (Организация)
                $rules['company_name'] = ['required', 'string', 'max:255'];
                $rules['unp'] = ['required', 'string', 'max:50'];
                $rules['position'] = ['required', 'string', 'max:255'];
                break;
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'type_owner.in' => 'Please select a valid ownership type',
            'fio.required' => 'Full name is required',
            'region.required' => 'Please select a region',
            'region.exists' => 'The selected region is invalid',
            'address.required' => 'Address is required',
            'phone.required' => 'Phone number is required',
            'email.required' => 'Email is required',
            'email.email' => 'Please provide a valid email address',
            'passport_series.required' => 'Passport series is required',
            'passport_number.required' => 'Passport number is required',
            'passport_issued_by.required' => 'Please specify who issued the passport',
            'passport_issued_date.required' => 'Passport issue date is required',
            'unp.required' => 'UNP (Tax ID) is required',
            'company_name.required' => 'Company name is required',
            'position.required' => 'Position is required',
            'documents.required' => 'You must upload at least one document',
            'documents.max' => 'You cannot upload more than 5 documents',
            'documents.*.mimes' => 'Documents must be PDF, PNG, JPEG, JPG, or WEBP files',
            'documents.*.max' => 'Each document must not exceed 10MB'
        ];
    }
}
