<?php

namespace App\Http\Requests\Clinic;

use App\Models\City;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClinicRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'filled|max:255',
            'address' => 'filled|max:255',
            'link' => 'nullable|max:255',
            'link_name' => 'filled|max:255',
            'longitude' => 'filled',
            'latitude' => 'filled',
            'description' => 'nullable|max:65536',
            'city_id' => 'filled|' . Rule::exists(City::class, 'id'),
        ];
    }
}
