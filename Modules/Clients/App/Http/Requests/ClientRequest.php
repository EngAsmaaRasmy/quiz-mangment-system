<?php

namespace Modules\Clients\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ClientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email',
            'subdomain' => 'required|string|max:255|unique:domains,domain',
            'mobile' => 'required|string|regex:/^\+?[0-9]{10,15}$/',
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(6),
            ],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function messages()
    {
        return [
            'name.required' => 'Please provide a name.',
            'email.required' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already in use.',
            'mobile.required' => 'Please provide a valid mobile number.',
            'mobile.regex' => 'Please provide a valid phone number (e.g., +1234567890).',
        ];
    }
}
