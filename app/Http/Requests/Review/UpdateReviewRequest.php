<?php

namespace App\Http\Requests\Review;

use App\Models\Clinic;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReviewRequest extends FormRequest
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
            'rating' => 'filled|numeric|min:1|max:5',
            'text' => 'filled|max:255',
            'clinic_id' => ['filled', Rule::exists(Clinic::class, 'id')],
        ];
    }
}
