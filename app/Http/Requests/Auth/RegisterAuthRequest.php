<?php

namespace App\Http\Requests\Auth;

use App\Models\EmailCode;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterAuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'max:255', Rule::unique(User::class, 'email')],
            'password' => 'required|min:8',
            'code' => 'required|' . Rule::exists(EmailCode::class, 'code')->where('email', $this->email),
        ];
    }
}
