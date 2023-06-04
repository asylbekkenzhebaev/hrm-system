<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'fio' => ['required', 'min:3', 'max:100'],
            'birthday' => ['required', 'date'],
            'gender_id' => ['required', 'exists:genders,id'],
            'department_id' => ['required', 'exists:departments,id'],
            'position_id' => ['required', 'exists:positions,id']
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'fio.required' => 'Имя не может быть пустым.',
            'fio.min' => 'Имя должно быть не менее 3 символов.',
            'fio.max' => 'Имя должно быть не более 100 символов.',
            'birthday.required' => 'Имя не может быть пустым.',
            'gender_id.required' => 'Пол не может быть пустым.',
            'gender_id.exists' => 'Выбранный идентификатор пола недействителен.',
            'department_id.required' => 'Отдел не может быть пустым.',
            'department_id.exists' => 'Выбранный идентификатор отдела недействителен.',
            'position_id.required' => 'Должность не может быть пустым.',
            'position_id.exists' => 'Выбранный идентификатор должности недействителен.'
        ];
    }
}
