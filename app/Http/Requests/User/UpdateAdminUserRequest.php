<?php

namespace App\Http\Requests\User;

use App\Enums\Gender;
use App\Enums\TypeOwners;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateAdminUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'address'    => ['required', 'string', 'max:255'],
            'gender'     => ['required', new Enum(Gender::class)],
//            'country_id' => ['required', 'string', 'exists:countries,id'],
            'is_active'  => ['required', 'boolean'],

            // UserData общие поля
            'user_data.type_owner'    => ['required', new Enum(TypeOwners::class)],
            'user_data.fio'           => ['required', 'string', 'max:255'],
            'user_data.region'        => ['nullable', 'string', 'max:255'],
            'user_data.address'       => ['required', 'string', 'max:255'],
            'user_data.phone'         => ['required', 'string', 'max:255'],
            'user_data.email'         => ['required', 'email', 'max:255'],
        ];

        // Дополнительные правила в зависимости от типа пользователя
        if ($this->input('user_data.type_owner') == TypeOwners::INDIVIDUAL->value) {
            $rules = array_merge($rules, [
                'user_data.passport_series'      => ['required', 'string', 'max:255'],
                'user_data.passport_number'      => ['required', 'string', 'max:255'],
                'user_data.passport_issued_by'   => ['required', 'string', 'max:255'],
                'user_data.passport_issued_date' => ['required', 'date'],
            ]);
        }

        if ($this->input('user_data.type_owner') == TypeOwners::COMMERCE->value) {
            $rules = array_merge($rules, [
                'user_data.unp' => ['required', 'string', 'max:255'],
            ]);
        }

        if ($this->input('user_data.type_owner') == TypeOwners::ORGANIZATION->value) {
            $rules = array_merge($rules, [
                'user_data.company_name' => ['required', 'string', 'max:255'],
                'user_data.unp'         => ['required', 'string', 'max:255'],
                'user_data.info'        => ['nullable', 'string'],
            ]);
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            // Общие поля пользователя
            'first_name.required' => __('The first name field is required.'),
            'last_name.required' => __('The last name field is required.'),
            'address.required' => __('The address field is required.'),
            'gender.required' => __('The gender field is required.'),
            'is_active.required' => __('The active status field is required.'),

            // Общие поля UserData
            'user_data.type_owner.required' => __('The user type field is required.'),
            'user_data.fio.required' => __('The full name field is required.'),
            'user_data.fio.max' => __('The full name must not exceed :max characters.'),
            'user_data.address.required' => __('The user address field is required.'),
            'user_data.region.max' => __('The region field must not exceed :max characters.'),
            'user_data.phone.required' => __('The phone field is required.'),
            'user_data.email.required' => __('The email field is required.'),
            'user_data.email.email' => __('Please enter a valid email address.'),

            // Поля для физических лиц
            'user_data.passport_series.required' => __('The passport series field is required for individual users.'),
            'user_data.passport_number.required' => __('The passport number field is required for individual users.'),
            'user_data.passport_issued_by.required' => __('The passport issued by field is required for individual users.'),
            'user_data.passport_issued_date.required' => __('The passport issued date field is required for individual users.'),
            'user_data.passport_issued_date.date' => __('The passport issued date must be a valid date.'),

            // Поля для ИП
            'user_data.unp.required' => __('The UNP field is required for this user type.'),

            // Поля для организаций
            'user_data.company_name.required' => __('The company name field is required for organization users.'),
        ];
    }
}
