<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends ApiController
{

    public function __construct()
    
    {
        $this->middleware('auth:api', ['except' => ['index', 'show','store','update','destroy']]);
    }

    /**
    * @OA\Get(
    *     path="/api/v1/brands",
    *     tags={"Marcas"},
    *     summary="Mostrar marcas existentes",
    *     description="Permite detallar los marcas registrados.",  
    *     @OA\Response(
    *         response=200,
    *         description="Operacion Exitosa."
    *     ),
     *      
    * )
    */
    
    public function index()
    {
        $brands = Brand::orderBy('id','DESC')->get();
        return $this->success('OK',$brands);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/brands", 
     *      tags={"Marcas"},          
     *      summary="Registrar nueva Marca",
     *      description="Permite registrar una nueva Marca.",        
     *      
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *          description="Nombre de la Marca",
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

    public function store(StoreBrandRequest $request)
    {
        $brand = Brand::create($request->all());
        return $this->success('OK',$brand);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/brands/{id}",
     *      tags={"Marcas"},
     *      summary="Obtener información de una Marca",
     *      description="Devuelve datos de una Marca específica según Id. ",
     *      @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
     *          description="Ingrese Id de una Marca existente",
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



    public function show(Brand $brand)
    {

        return $this->success('OK',$brand);

    }

   /**
     * @OA\Put(
     *      path="/api/v1/brands/{id}", 
     *      tags={"Marcas"},          
     *      summary="Actualizar una Marca existente",
     *      description="Permite modificar datos de una Marca existente.",        
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="Id de Marca",
     *          @OA\Schema(
     *          type="integer"
     *          )
     *      ), 
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *          description="Nombre de la Marca",
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


    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->fill($request->all())->save();
        return $this->success('OK',$brand);
    }


    /**
     * @OA\Delete(
     *      path="/api/v1/brands/{id}",
     *      tags={"Marcas"},
     *      summary="Eliminar Marca existente",
     *      description="Permite eliminar un registro y no devuelve contenido.",
     *      @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
     *          description="Id de Marca a eliminar",
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
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return $this->success('OK',$brand);
    }
}
