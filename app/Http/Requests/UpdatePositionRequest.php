<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePositionRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:100', 'unique:positions,name,' . $this->position->id],
            'department_id' => ['required', 'exists:departments,id']
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'name.required' => 'Имя не может быть пустым.',
            'name.min' => 'Имя должно быть не менее 3 символов.',
            'name.max' => 'Имя должно быть не более 100 символов.',
            'name.unique' => 'Имя уже занято.',
            'department_id.required' => 'Отдел не может быть пустым.',
            'department_id.exists' => 'Выбранный идентификатор отдела недействителен.'
        ];
    }
}
