<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name' => 'required|min:2|max:255|regex:/^[a-zA-Zа-яА-ЯёЁ]+$/u',
            'phone' => 'required|numeric|min:9|max:255',
            'comment' => 'nullable|max:255',
            'address' => 'required|min:10',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя должно быть указано',
            'name.min' => 'Минимальное количество символов не менее 2',
            'name.max' => 'Максимальное количество символов 255',
            'name.regex' => 'Имя не должно содержать численные значения',

            'phone.required' => 'Поле обязательно для заполнения',
            'phone.numeric' => 'Номер должен состоять из цифр',
            'phone.min' => 'Минимальное количество символов - 2',
            'phone.max' => 'Максимальное количество символов - 255',

            'address.required' => 'Поле обязательно для заполнения',
            'address.min' => 'Минимальное количество символов - 10',
        ];
    }
}
