<?php

namespace App\Http\Requests\Auth;

use App\Rules\Username;
use App\Traits\PasswordEnvironments;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    use PasswordEnvironments;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'type_owner' => ['required', 'integer', 'in:0,1,3'],
            'fio' => ['required', 'string', 'max:255', 'min:2'],
            'region' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email'],
            'password' => $this->passwordRules(app()->environment()),
            'password_confirmation' => ['required', 'same:password'],
            'terms' => 'required|accepted',
        ];

        // Добавляем правила в зависимости от типа владельца
        switch (request()->input('type_owner')) {
            case 0: // Individual
                $rules['passport_series'] = ['required', 'string', 'max:10'];
                $rules['passport_number'] = ['required', 'string', 'max:20'];
                $rules['passport_issued_by'] = ['required', 'string', 'max:255'];
                $rules['passport_issued_date'] = ['required', 'date'];
                break;
            case 1: // Commerce
                $rules['unp'] = ['required', 'string', 'max:50'];
                break;
            case 3: // Organization
                $rules['unp'] = ['required', 'string', 'max:50'];
                $rules['company_name'] = ['required', 'string', 'max:255'];
                $rules['info'] = ['nullable', 'string'];
                break;
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'type_owner.required' => __('The user type is required'),
            'type_owner.integer' => __('The user type must be valid'),
            'type_owner.in' => __('The selected user type is invalid'),

            'fio.required' => __('The full name field is required'),
            'fio.min' => __('The full name must be at least :min characters'),
            'fio.max' => __('The full name cannot exceed :max characters'),

            'region.required' => __('The region field is required'),
            'region.max' => __('The region cannot exceed :max characters'),

            'address.required' => __('The address field is required'),
            'address.max' => __('The address cannot exceed :max characters'),

            'phone.required' => __('The phone number is required'),
            'phone.max' => __('The phone number cannot exceed :max characters'),

            'email.required' => __('The email address is required'),
            'email.email' => __('Please enter a valid email address'),
            'email.max' => __('The email cannot exceed :max characters'),
            'email.unique' => __('This email is already registered'),

            'password.required' => __('The password is required'),
            'password.min' => __('The password must be at least :min characters'),
            'password.confirmed' => __('The password confirmation does not match'),

            'password_confirmation.required' => __('Please confirm your password'),
            'password_confirmation.same' => __('The passwords do not match'),

            'terms.required' => __('You must accept the terms and conditions'),
            'terms.accepted' => __('You must accept the terms and conditions'),

            // Individual
            'passport_series.required' => __('The passport series is required'),
            'passport_series.max' => __('The passport series cannot exceed :max characters'),

            'passport_number.required' => __('The passport number is required'),
            'passport_number.max' => __('The passport number cannot exceed :max characters'),

            'passport_issued_by.required' => __('The passport issued by field is required'),
            'passport_issued_by.max' => __('The passport issued by cannot exceed :max characters'),

            'passport_issued_date.required' => __('The passport issue date is required'),
            'passport_issued_date.date' => __('Please enter a valid date'),

            // Commerce and Organization
            'unp.required' => __('The UNP field is required'),
            'unp.max' => __('The UNP cannot exceed :max characters'),

            // Organization
            'company_name.required' => __('The company name is required'),
            'company_name.max' => __('The company name cannot exceed :max characters'),
        ];
    }
}
