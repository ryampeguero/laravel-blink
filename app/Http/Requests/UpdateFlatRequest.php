<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFlatRequest extends FormRequest
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
        return [
            'name' => ['required', 'min:5'],
            'slug' => ['required'],
            'rooms' => ['required'],
            'bathrooms' => ['required'],
            'beds' => ['required'],
            'square_meters' => ['required'],
            'address' => ['required' , 'min:5'],
            'img_path' => ['nullable'],
            'services'=> ['nullable', 'exists:services,id'],
            'visible' => ['nullable'],
            
        ];
    }
     /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages() {
        return [
            'name.required' => 'Il nome non può essere vuoto',
            'name.min' => 'Il nome deve contenere almeno 5 caratteri',
            'slug.required' => 'Slug non può essere vuoto',
            'rooms' => 'Stanze non può essere vuoto',
            'bathrooms' => 'Bagni non può essere vuoto',
            'beds' => 'Letti non può essere vuoto',
            'square_meters' => 'Metri quadrati non può essere vuoto',
            'address' => 'Indirizzo non può essere vuoto',
        ];
    }
}
