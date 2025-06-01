<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrateRequest extends FormRequest
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
            'name'     => 'required|min:2|max:255|regex:/^[a-zA-Zа-яА-ЯёЁ]+$/u',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ];
    }

    public function messages(): array
    {
        return [
          'name.required' => 'Имя должно быть указано',
          'name.min' => 'Минимальное количество символов не менее 2',
          'name.max' => 'Максимальное количество символов 255',
          'name.regex' => 'Имя не должно содержать численные значения',

          'email.required' => 'Имя не должно содержать численные значения',
          'email.email' => 'Невалидный email',
          'email.unique' => 'email уже занят',

          'password.required' => 'Введите пароль',
          'password.min' => 'Пароль должен состоять не меньше 6 символов',
          'password.confirmed' => 'Пароли не совпадают'
        ];
    }
}
