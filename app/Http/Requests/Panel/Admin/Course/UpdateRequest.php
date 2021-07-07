<?php

namespace App\Http\Requests\Panel\Admin\Course;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'grade_id' => 'required',
            'section_id' => 'required',
            'period_id' => 'required',
            'teacher_id' => 'required',
            'name' => ['required', 'min:3', 'max:100'],
            'description' => ['sometimes', 'nullable', 'max: 10000'],
        ];
    }

    public function messages()
    {
        return [
            'grade_id.required' => 'Eliga un grado.',
            'section_id.required' => 'Eliga una sección.',
            'period_id.required' => 'Eliga una periodo.',
            'teacher_id.required' => 'Eliga un profesor.',
            'name.required' => 'Ingrese el nombre del curso',
            'name.min' => 'Ingrese el nombre del curso al menos 3 caracteres.',
            'name.max' => 'Ingrese el nombre del curso hasta 100 caracteres.',
            'description.max' => 'La descripción del curso es hasta 10,000 caracteres.',
        ];
    }
}
