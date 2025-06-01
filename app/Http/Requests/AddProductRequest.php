<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'product_id' => 'required|integer|min:1|exists:products,id',
            'amount' => 'required|integer|min:1|'
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'id продукта должен быть указан',
            'product_id.integer' => 'id продукта обязательно должно быть целым числом',
            'product_id.min' => 'такого id нет',
            'product_id.exists' => 'продукт не найден в таблице продуктов',

            'amount.required' => 'укажите количество добавляемого товара',
            'amount.integer' => 'число должно быть целым',
            'amount.min' => 'нельзя добавить число меньше 0',
        ];
    }
}
