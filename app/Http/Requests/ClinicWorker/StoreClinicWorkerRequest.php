<?php

namespace App\Http\Requests\ClinicWorker;

use App\Enum\ClinicWorkerRole;
use App\Models\Clinic;
use App\Utils\EnumFields;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClinicWorkerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && Clinic::whereHas('clinic_workers', function ($q) {
            $q->where('user_id', auth()->id());
        });
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'name' => 'required|max:255',
            'role' => ['required', Rule::in(EnumFields::getColumn(ClinicWorkerRole::class))],
            'clinic_id' => ['required', Rule::exists(Clinic::class, 'id')]
        ];
    }
}
