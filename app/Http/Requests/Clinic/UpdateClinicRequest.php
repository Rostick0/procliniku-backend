<?php

namespace App\Http\Requests\Clinic;

use App\Models\City;
use App\Models\Image;
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
            'link' => 'nullable|url|max:255',
            'link_name' => 'filled|max:255',
            'longitude' => 'filled',
            'latitude' => 'filled',
            'description' => 'nullable|max:65536',
            'icon_id' => ['nullable', Rule::exists(Image::class, 'id')],
            'link_vk' => 'nullable|url|max:255',
            'link_videohost' => 'nullable|url|max:255',
            'city_id' => 'filled|' . Rule::exists(City::class, 'id'),
            'work_times' => 'array|max:7',
            'work_times.*.day' => ['nullable', Rule::in([0, 1, 2, 3, 4, 5, 6])],
            'work_times.*.time_start' => 'nullable|date_format:H:i:s',
            'work_times.*.time_end' => 'nullable|date_format:H:i:s|after:work_times.time_start.*',
        ];
    }
}
