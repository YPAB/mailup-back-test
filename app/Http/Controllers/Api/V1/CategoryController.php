<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends ApiController
{
    public function __construct()
    
    {
        $this->middleware('auth:api', ['except' => ['index', 'show','store','update','destroy']]);
    }
    
     /**
    * @OA\Get(
    *     path="/api/v1/categories",
    *     tags={"Categorías"},
    *     summary="Mostrar categorias existentes",
    *     description="Permite detallar los categorias registradas.",  
    *     @OA\Response(
    *         response=200,
    *         description="Operacion Exitosa."
    *     ),
     *      
    * )
    */

    public function index()
    {
        $categories = Category::orderBy('id','DESC')->get();
        return $this->success('OK',$categories);
    }

    
    /**
     * @OA\Post(
     *      path="/api/v1/categories", 
     *      tags={"Categorías"},          
     *      summary="Registrar nueva Categoría",
     *      description="Permite registrar una nueva Categoría.",        
     *      
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *          description="Nombre de la Categoría",
     *          @OA\Schema(
     *              type="string"
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





    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());
        return $this->success('OK',$category);
    }

    

    /**
     * @OA\Get(
     *      path="/api/v1/categories/{id}",
     *      tags={"Categorías"},
     *      summary="Obtener información de una Categoría",
     *      description="Devuelve datos de una Categoría específica según Id. ",
     *      @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
     *          description="Ingrese Id de una Categoría existente",
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




    public function show(Category $category)
    {
        return $this->success('OK',$category);
    }

    

     /**
     * @OA\Put(
     *      path="/api/v1/categories/{id}", 
     *      tags={"Categorías"},          
     *      summary="Actualizar una Categoría existente",
     *      description="Permite modificar datos de una Categoría existente.",        
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
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
     *          description="Nombre de la Categoría",
     *          @OA\Schema(
     *              type="string"
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




    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->fill($request->all())->save();
        return $this->success('OK',$category);
    }

   
    /**
     * @OA\Delete(
     *      path="/api/v1/categories/{id}",
     *      tags={"Categorías"},
     *      summary="Eliminar Categoría existente",
     *      description="Permite eliminar un registro y no devuelve contenido.",
     *      @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
     *          description="Id de Categoría a eliminar",
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

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->success('OK',$category);
    }
}
