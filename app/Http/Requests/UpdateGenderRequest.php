<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGenderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:100', 'unique:genders,name,' . $this->gender->id]
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'required' => 'Имя не может быть пустым.',
            'min' => 'Имя должно быть не менее 3 символов.',
            'max' => 'Имя должно быть не более 100 символов.',
            'unique' => 'Имя уже занято.'
        ];
    }
}
