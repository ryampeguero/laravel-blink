<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFlatRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255 ', 'unique:flats,name'],
            'rooms' => 'required|integer|not_in:0|gt:-1 ',
            'bathrooms' => 'required|integer|not_in:0|gt:-1 ',
            'beds' => 'required|integer|not_in:0|gt:-1 ',
            'square_meters' => 'required|integer|not_in:0|gt:-1',
            'address' => 'required|string|min:3|max:255',
            'latitude' => ' nullable',
            'longitude' => 'nullable ',
            'img_path' => 'nullable',
            'services'=> ['nullable', 'exists:services,id'],
            'visible' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il nome dell\'appartamento è obbligatorio',
            'name.string' => 'Il nome dell\'appartamento deve essre composto da una stringa',
            'name.min' => 'Il nome dell\'appartamento deve avere almeno 3 caratteri',
            'name.max' => 'Il nome dell\'appartamento non può superare i 255 caratteri',
            'name.unique' => 'Il nome dell\'appartamento è già preso',
            'rooms.required' => 'Il numero delle camere è obligatorio',
            'rooms.integer' => 'Il numero delle camere deve esseere un numero intero',
            'rooms.not_in' => 'Il numero delle camere non può essere 0',
            'rooms.gt' => 'Il numero delle camere non può essere negativo',
            'beds.required' => 'Il numero di letti è obligatorio',
            'beds.integer' => 'Il numero di letti deve esseere un numero intero',
            'beds.not_in' => 'Il numero di letti non può essere 0',
            'beds.gt' => 'Il numero di letti non può essere negativo',
            'bathrooms.required' => 'Il numero di bagni è obligatorio',
            'bathrooms.integer' => 'Il numero di bagni deve esseere un numero intero',
            'bathrooms.not_in' => 'Il numero di bagni non può essere 0',
            'bathrooms.gt' => 'Il numero di bagni non può essere negativo',
            'square_meters.required' => 'I metri quadri è obligatorio',
            'square_meters.integer' => 'I metri quadri deve esseere un numero intero',
            'square_meters.not_in' => 'I metri quadri non può essere 0',
            'square_meters.gt' => 'I metri quadri non può essere negativo',
            'address.required' => 'L\'indirizzo è obbligatorio',
            'address.string' => 'L\'indirizzo deve essre composto da una stringa',
            'address.min' => 'L\'indirizzo deve avere almeno 3 caratteri',
            'address.max' => 'L\'indirizzo non può superare i 255 caratteri',
            'visible' => 'Devi scegliere se pubblicare o no la camera',
            'visible' => 'Valore non valido',

        ];
    }
}
