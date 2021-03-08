<?php
/**
 * Created by PhpStorm.
 * User: lets
 * Date: 13/11/2018
 * Time: 11:21
 */

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product.oem' => 'required|string|max:30',
            'product.model_no' => 'required|string|max:40',
            'product.product_type' => 'required|string',
            'product.price' => 'required|max:10',
            'product.config' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'product.oem.max' => 'The OEM may not be greater than 30 characters.',
            'product.oem.required' => 'The OEM field is required',
            'product.model_no.required' => 'The Model number is required',
            'product.price.required' => 'The Product price is required',
            'product.config.required' => 'The Product Configuration Assumption is required'
        ];
    }
}
