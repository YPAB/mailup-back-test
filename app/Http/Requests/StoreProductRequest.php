<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckPriceRule;
use Illuminate\Support\Facades\Auth;

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
            'brand_id'     => 'required|exists:brands,id',
            'category_id'  => 'required|exists:categories,id',
            'name'         => 'required|unique:products,name|max:200',
            'description'  => 'nullable',
            'image'        => 'required|mimes:jpg,jpeg,png|max:1024',
            'price'        =>  ['required', new CheckPriceRule()],
            'price_sale'   =>  ['required', new CheckPriceRule()],
            'stock'        => 'required|integer'

        ];
    }
}
