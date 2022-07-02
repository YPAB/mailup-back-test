<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       // final array to be return.
        $products = [];

        foreach($this->collection as $product) {


             array_push($products, [
                 'name'         => $product->name,
                 'description'  => $product->description,
                 'image'        => $product->image,
                 'brand'        => $product->brand->name,
                 'price'        => $product->price,
                 'price_sale'   => $product->price_sale,
                 'category'     => $product->category->name,
                 'stock'        => $product->stock
             ]);

        }

        return $products;
    }
}
