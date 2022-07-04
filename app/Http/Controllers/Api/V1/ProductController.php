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
        $this->middleware('auth:api', ['except' => ['index', 'show','store','update','destroy','searchProducts']]);
    }
    
    /**
    * @OA\Get(
    *     path="/api/v1/products",
    *     tags={"Productos"},
    *     summary="Mostrar productos existentes",
    *     description="Permite detallar los productos registrados.",  
    *     @OA\Response(
    *         response=200,
    *         description="Operacion Exitosa."
    *     ),
     *      
    * )
    */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $products = new ProductCollection (Product::with('brand','category')
                ->where('name','like','%'.$search.'%')
                ->orderBy('id')
                ->paginate(5));

        return $this->success('OK',$products);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/products", 
     *      tags={"Productos"},          
     *      summary="Registrar nuevo producto",
     *      description="Permite registrar un nuevo Producto.",
     *      
     
     *      @OA\Parameter(
     *          name="brand_id",
     *          in="query",
     *          required=true,
     *          description="Id de Marca",
     *          @OA\Schema(
     *          type="integer"
     *          )
     *      ),
     * 
     *      @OA\Parameter(
     *          name="category_id",
     *          in="query",
     *          required=true,
     *          description="Id de Categoría",
     *          @OA\Schema(
     *          type="integer"
     *          )
     *      ),            
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *          description="Nombre",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="description",
     *          in="query",
     *          required=true,
     *          description="Descripción",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     * 
      * @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="Imagen",
     *                     property="image",
     *                     type="file",
     *                ),
     *                 required={"image"}
     *             )
     *         )
     *     ),
     * 
     *      @OA\Parameter(
     *          name="price",
     *          in="query",
     *          required=true,
     *          description="Precio",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * 
     *      @OA\Parameter(
     *          name="price_sale",
     *          in="query",
     *          required=true,
     *          description="Precio Venta",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),


           @OA\Parameter(
     *          name="stock",
     *          in="query",
     *          required=true,
     *          description="Stock",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
    
     *      
     *      @OA\Response(
     *          response=200,
     *          description="Operacion exitosa.",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      
     *      @OA\Response(
     *          response=401,
     *          description="Sin autenticar.",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="El campo ya esta en uso.",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Prohibido. No posee permisos para ejecutar esta accion."
     *      )
     * )
     */



    public function store(StoreProductRequest $request)
    {
        $data = $request->all();

        $data['image'] = $request->file('image')->store('img/img-productos');

        $product = Product::create($data);
        return $this->success('OK',$product);
    }

    
    /**
     * @OA\Get(
     *      path="/api/v1/products/{id}",
     *      tags={"Productos"},
     *      summary="Obtener información de un Producto",
     *      description="Devuelve datos de un Producto específica según Id. ",
     *      @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
     *          description="Ingrese Id de un Producto existente",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operacion exitosa.",
     *          
     *       ),
     *      
     *      @OA\Response(
     *          response=401,
     *          description="Sin autenticar.",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Prohibido. No posee permisos para ejecutar esta accion."
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Recurso no encontrado."
     *      )
     * )
     */


    public function show(Product $product)
    {
        $product = new ProductResource(Product::with('brand','category')->findOrFail($product->id));
        return $this->success('OK',$product);
    }

    
    /**
     * @OA\Put(
     *      path="/api/v1/products/{id}", 
     *      tags={"Productos"},          
     *      summary="Actualizar un Producto existente",
     *      description="Permite modificar datos de un Producto existente.",
     * 
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="Id de Producto",
     *          @OA\Schema(
     *          type="integer"
     *          )
     *      ),
     *      
     *      @OA\Parameter(
     *          name="brand_id",
     *          in="query",
     *          required=true,
     *          description="Id de Marca",
     *          @OA\Schema(
     *          type="integer"
     *          )
     *      ),
     * 
     *      @OA\Parameter(
     *          name="category_id",
     *          in="query",
     *          required=true,
     *          description="Id de Categoría",
     *          @OA\Schema(
     *          type="integer"
     *          )
     *      ),            
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *          description="Nombre",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="description",
     *          in="query",
     *          required=true,
     *          description="Descripción",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     * 
      * @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="Imagen",
     *                     property="image",
     *                     type="file",
     *                ),
     *                 required={"image"}
     *             )
     *         )
     *     ),
     * 
     *      @OA\Parameter(
     *          name="price",
     *          in="query",
     *          required=true,
     *          description="Precio",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * 
     *      @OA\Parameter(
     *          name="price_sale",
     *          in="query",
     *          required=true,
     *          description="Precio Venta",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),


           @OA\Parameter(
     *          name="stock",
     *          in="query",
     *          required=true,
     *          description="Stock",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
    
     *      
     *      @OA\Response(
     *          response=200,
     *          description="Operacion exitosa.",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      
     *      @OA\Response(
     *          response=401,
     *          description="Sin autenticar.",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="El campo ya esta en uso.",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Prohibido. No posee permisos para ejecutar esta accion."
     *      )
     * )
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
     * @OA\Delete(
     *      path="/api/v1/products/{id}",
     *      tags={"Productos"},
     *      summary="Eliminar Producto existente",
     *      description="Permite eliminar un registro y no devuelve contenido.",
     *      @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
     *          description="Id de Producto a eliminar",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operacion exitosa.",
     *          
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Sin autenticar.",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Prohibido. No posee permisos para ejecutar esta accion."
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Recurso no encontrado."
     *      )
     * )
     */

    public function destroy(Product $product)
    {
        $product->delete();
        return $this->success('OK',$product);
    }


    public function searchProducts($search = null)
    {
        $products = new ProductCollection (Product::with('brand','category')
                ->where('name','like','%'.$search.'%')
                ->orderBy('id')
                ->paginate(6));

        return $this->success('OK',$products);

    }
}
