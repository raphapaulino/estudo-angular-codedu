<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
        /** @TODO criar regra que verifica se a categoria que está sendo vinculada pertence a empresa autenticada */
        /** @TODO pensar se é necessário que as categorias devam ser enviadas com um array e criar uma regra que valide isso */
        return [
            'categories' => 'required|exists:categories,id'
        ];
    }
}
