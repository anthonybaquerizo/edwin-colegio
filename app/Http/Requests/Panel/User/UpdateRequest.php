<?php

namespace App\Http\Requests\Panel\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'txt_dni' => ['required', 'numeric', 'digits:8'],
            'txt_lastname' => ['required', 'string', 'max:100'],
            'txt_names' => ['required', 'string', 'max:100'],
            'txt_email' => ['required', 'email', 'max:100', 'unique:user,email,' . $this->user()->id],
            'txt_phone' => ['present', 'nullable', 'numeric', 'digits:9'],
            'cbo_gender' => ['required', Rule::in(['H', 'M', 'O'])],
            'txt_password' => ['present', 'nullable', 'string', 'max:100'],
        ];
    }

    public function messages()
    {
        return [
            'txt_dni.required' => 'Debe ingresar su nro de DNI.',
            'txt_dni.numeric' => 'Su DNI debe ser numerico.',
            'txt_dni.digits' => 'Su DNI debe ser numerico de 8 digitos.',
            'txt_lastname.required' => 'Debe ingresar su apellido.',
            'txt_lastname.string' => 'Su apellido debe ser alfanumericos.',
            'txt_lastname.max' => 'Su apellido debe ser alfanumericos hasta 100 caracteres.',
            'txt_names.required' => 'Debe ingresar su nombre completo.',
            'txt_names.string' => 'Su nombre debe ser alfanumericos.',
            'txt_names.max' => 'Su nombre debe ser alfanumericos hasta 100 caracteres.',
            'txt_email.required' => 'Debe ingresar su correo electrónico.',
            'txt_email.email' => 'Su E-mail no tiene el formato correcto.',
            'txt_email.max' => 'Su E-mail debe ser hasta 100 caracteres.',
            'txt_email.unique' => 'Su E-mail ya le pertenece a otra persona.',
            'txt_phone.numeric' => 'Su nro de célular debe ser numerico',
            'txt_phone.digits' => 'Su nro de célular Debe ser numerico de 9 digitos.',
            'cbo_gender.required' => 'Debes elegir su sexo.',
            'cbo_gender.in' => 'El valor de su sexo es incorrecto.',
            'txt_password.string' => 'Su nueva contraseña debe ser una cadena de caracteres.',
            'txt_password.max' => 'Su nueva contraseña debe ser una cadena hasta 100 caracteres.',
        ];
    }
}
