<?php

namespace App\Http\Requests\Panel\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class ResourceRequest extends FormRequest
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
            'course_id' => ['required'],
            'title' => ['required', 'string', 'max:100'],
            'description' => ['sometimes', 'nullable', 'max: 10000'],
            'file' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'course_id.required' => 'Debe enviar el curso.',
            'title.required' => 'Debes ingresar el titulo del recurso',
            'title.max' => 'El titulo es solol hasta 100 caracteres.',
            'description.max' => 'El titulo es solol hasta 10,000 caracteres.',
            'file.required' => 'Debe existir un archivo para el recurso.',
        ];
    }
}
