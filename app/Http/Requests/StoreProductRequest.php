<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckPriceRule;

class StoreProductRequest extends FormRequest
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
            'category_id'  => 'required|exists:categories,id',
            'brand_id'     => 'required|exists:brands,id',
            'name'         => 'required|unique:products,name|max:200',
            'description'  => 'nullable',
            'image'        => 'required|mimes:jpg,jpeg,png|max:1024',
            'price'        =>  ['required', new CheckPriceRule()],
            'price_sale'   =>  ['required', new CheckPriceRule()],
            'stock'        => 'required|integer'

        ];
    }
}
