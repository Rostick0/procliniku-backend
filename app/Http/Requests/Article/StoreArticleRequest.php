<?php

namespace App\Http\Requests\Article;

use App\Models\Clinic;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticleRequest extends FormRequest
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
            'title' => 'required|max:255',
            'content' => 'required|max:65536',
            'clinic_id' => ['required', Rule::exists(Clinic::class, 'id')],
            'is_show' => 'boolean',
        ];
    }
}
