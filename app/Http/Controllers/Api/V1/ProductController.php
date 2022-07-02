<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;

class ProductController extends ApiController
{

    public function __construct()
    
    {
        $this->middleware('auth:api', ['except' => ['index', 'show','store','update','destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = new ProductCollection(Product::with('brand','category')->get());

        return $this->success('OK',$products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->all();

        $data['image'] = $request->file('image')->store('img/img-productos');

        $product = Product::create($data);
        return $this->success('OK',$product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product = new ProductResource(Product::with('brand','category')->findOrFail($product->id));
        return $this->success('OK',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {


        if (!empty($request->image) && !empty($product->image)){
            Storage::delete($product->image);
            $product->image = $request->image->store('img/img-productos');
        }

        if (!empty($request->image) && empty($product->image)){
            $product->image = $request->image->store('img/img-productos');
        }

        $product->fill([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'sport_id' => $request->sport,
            'name'      => $request->name,
            'description,' => $request->description,
            'price,' => $request->price,
            'price_sale,' => $request->price_sale,
            'stock,' => $request->stock,
         ])->save();
        
        return $this->success('OK',$product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->success('OK',$product);
    }
}
