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
            'contact_name' => 'required|min:2|max:255|regex:/^[a-zA-Zа-яА-ЯёЁ\s\-]+$/u',
            'contact_phone' => 'required|digits_between:9,30',
            'comment' => 'nullable|max:255',
            'address' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'contact_name.required' => 'Поле обязательно для заполнения',
            'contact_name.min' => 'Минимальное количество символов не менее 2',
            'contact_name.max' => 'Максимальное количество символов 255',
            'contact_name.regex' => 'Имя не должно содержать численные значения',

            'contact_phone.required' => 'Поле обязательно для заполнения',
            'contact_phone.digits_between' => 'Номер должен быть от 9 до 30 символов',

            'address.required' => 'Поле обязательно для заполнения',
        ];
    }
}
