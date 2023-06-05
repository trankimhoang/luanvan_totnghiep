<?php

namespace App\Http\Requests\Admin;

use App\Rules\IsValidQuantityProduct;
use App\Rules\ValidateQuantityProduct;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
        $type = $this->request->get('type');
        $rules = [
            'name' => 'required|unique:products,name,' . $this->request->get('id'),
            'quantity' => ['required', 'numeric', 'min:1', new IsValidQuantityProduct($this->request->get('id'))],
            'price' => 'required|numeric|min:0',
            'category_id' => 'required',
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ];

        if ($type == 'configurable') {
            unset($rules['price']);
            unset($rules['quantity']);
        }

        return $rules;
    }
}
