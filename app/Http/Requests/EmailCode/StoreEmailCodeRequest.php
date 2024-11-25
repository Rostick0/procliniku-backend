<?php

namespace App\Http\Requests\EmailCode;

use App\Enum\EmailCodeType;
use App\Models\User;
use App\Utils\EnumFields;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmailCodeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'email' => 'required|email|max:255',
            'type' => ['required', 'in:' . EnumFields::getValidateValues(EmailCodeType::class)]
            // 'g_recaptcha_response' => 'required|captcha'
        ];

        if ($this->request->get('type') === EmailCodeType::login->value) {
            $rules['email'] = $rules['email'] . '|' . Rule::exists(User::class, 'email');
        } else if ($this->request->get('type') === EmailCodeType::update_email->value) {
            $rules['email'] = $rules['email'] . '|' . Rule::exists(User::class, 'email')->where('id', $this->user()->id);
            $rules['email_new'] =  Rule::unique(User::class, 'email');
        } else if ($this->request->get('type') === EmailCodeType::register->value) {
            $rules['email'] = $rules['email'] . '|' . Rule::unique(User::class, 'email');
        }

        return $rules;
    }
}
