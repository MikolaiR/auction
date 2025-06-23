<?php

namespace App\Http\Requests\Profile;

use App\Enums\Gender;
use App\Traits\PasswordEnvironments;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateProfileRequest extends FormRequest
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
        return [
            'current_password' => $this->passwordRules(app()->environment(), false),
            'password' => [$this->passwordRules(app()->environment(), false), 'confirmed', 'required_with:current_password'],
            'password_confirmation' => ['required_with:password'],
        ];
    }
}
