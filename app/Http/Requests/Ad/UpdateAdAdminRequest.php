<?php

namespace App\Http\Requests\Ad;

use App\Enums\AdStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateAdAdminRequest extends FormRequest
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
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'min:10'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'video_url' => ['nullable', 'url', 'active_url'],
            'category' => ['nullable', 'exists:categories,slug'],
            'subcategory' => ['nullable', 'exists:categories,slug'],
            'start_date' => ['nullable', 'date', 'after:today'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
            'seller_mobile' => ['nullable', 'string', 'max:15', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'seller_address' => ['nullable', 'string', 'max:255'],
            'seller_name' => ['nullable', 'string', 'max:255'],
            'seller_email' => ['nullable', 'string', 'email', 'max:255'],
            'status' => ['nullable', new Enum(AdStatus::class)]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.string' => __('The title must be a string.'),
            'title.max' => __('The title may not be greater than :max characters.'),
            
            'description.string' => __('The description must be a string.'),
            'description.min' => __('The description must be at least :min characters.'),
            
            'price.numeric' => __('The price must be a number.'),
            'price.min' => __('The price must be at least :min.'),
            
            'video_url.url' => __('The video URL format is invalid.'),
            'video_url.active_url' => __('The video URL is not a valid active URL.'),
            
            'category.exists' => __('The selected category is invalid.'),
            'subcategory.exists' => __('The selected subcategory is invalid.'),
            
            'start_date.date' => __('The start date must be a valid date.'),
            'start_date.after' => __('The start date must be a date after today.'),
            
            'end_date.date' => __('The end date must be a valid date.'),
            'end_date.after' => __('The end date must be a date after the start date.'),
            
            'seller_mobile.string' => __('The seller mobile must be a string.'),
            'seller_mobile.max' => __('The seller mobile may not be greater than :max characters.'),
            'seller_mobile.min' => __('The seller mobile must be at least :min characters.'),
            'seller_mobile.regex' => __('The seller mobile format is invalid. Please use only numbers, spaces, and the symbols +()-.'),
            
            'seller_address.string' => __('The seller address must be a string.'),
            'seller_address.max' => __('The seller address may not be greater than :max characters.'),
            
            'seller_name.string' => __('The seller name must be a string.'),
            'seller_name.max' => __('The seller name may not be greater than :max characters.'),
            
            'seller_email.string' => __('The seller email must be a string.'),
            'seller_email.email' => __('The seller email must be a valid email address.'),
            'seller_email.max' => __('The seller email may not be greater than :max characters.'),
            
            'status.enum' => __('The selected status is invalid.')
        ];
    }
}