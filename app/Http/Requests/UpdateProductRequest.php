<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\CheckPriceRule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
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
            'name'         => 'required|max:200|unique:products,name,'.$this->product->id,
            'description'  => 'nullable',
            'image'        => 'required|mimes:jpg,jpeg,png|max:1024',
            'price'        =>  ['required', new CheckPriceRule()],
            'price_sale'   =>  ['required', new CheckPriceRule()],
            'stock'        => 'required|integer'
        ];
    }
}
