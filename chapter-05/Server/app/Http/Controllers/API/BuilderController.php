<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Builder;
use Validator;
use App\Http\Resources\BuildersResource;
class BuilderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/builders",
     *     tags={"Builders"},
     *     summary="List Builders",
     *     @OA\Response(
     *          response=200,
     *          description="Success: List all Builders",
     *          @OA\Schema(ref="#/definitions/Builder")
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="Not Found"
     *   )
     * ),
     */
    public function index()
    {
        $listBuilder = Builder::all();
        return $listBuilder;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *     path="/api/builders",
     *     tags={"Builders"},
     *     summary="Create Builder",
     *   @OA\RequestBody(
     *       required=false,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="name",
     *                   description="Updated name of the pet",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="status",
     *                   description="Updated status of the pet",
     *                   type="string"
     *               ),
     *           )
     *       )
     *   ),
     *     @OA\Response(
     *          response=201,
     *          description="Success: A Newly Created Builder",
     *          @OA\Schema(ref="#/definitions/Builder")
     *      ),
     *     @OA\Response(
     *          response="422",
     *          description="Missing mandatory field"
     *     ),
     *     @OA\Response(
     *          response="404",
     *          description="Not Found"
     *     ),
     *     @OA\Response(
     * 			response="405",
     * 			description="Invalid HTTP Method"
     *      )
     * ),
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',            
            'location'=> 'required'
            ]);
            
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);    
        }

        $createBuilder = Builder::create($request->all());
        return $createBuilder;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/builders/{id}",
     *     tags={"Builders"},
     *     summary="Get Builder by Id",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
    *          @OA\Schema(
     *              type="integer"
     *          ),
     *          description="Display the specified Builder by id.",
     * 		),
     *     @OA\Response(
     *          response=200,
     *          description="Success: Return the Builder",
     *          @OA\Schema(ref="#/definitions/Builder")
     *      ),
     *     @OA\Response(
     *          response="404",
     *          description="Not Found"
     *     ),
     *     @OA\Response(
     * 			response="405",
     * 			description="Invalid HTTP Method"
     *      )
     * ),
     */
    public function show(Builder $builder)
    {
        // $showBuilderById = Builder::with('Bike')->findOrFail($id);
        // return $showBuilderById;

        return new BuildersResource($builder);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Put(
     *     path="/api/builders/{id}",
     *     tags={"Builders"},
     *     summary="Update Builder",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *          description="Update the specified Builder by id.",
     * 		),
     *   @OA\RequestBody(
     *       required=false,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="name",
     *                   description="Updated name of the pet",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="status",
     *                   description="Updated status of the pet",
     *                   type="string"
     *               ),
     *           )
     *       )
     *   ),
     *     @OA\Response(
     *          response=200,
     *          description="Success: Return the Builder updated",
     *          @OA\Schema(ref="#/definitions/Builder")
     *      ),
     *     @OA\Response(
     *          response="422",
     *          description="Missing mandatory field"
     *     ),
     *     @OA\Response(
     *          response="404",
     *          description="Not Found"
     *     ),
     *     @OA\Response(
     * 			response="405",
     * 			description="Invalid HTTP Method"
     *     )
     * ),
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',            
            'location'=> 'required'
            ]);
            
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);    
        }
        
        $updateBuilderById = Builder::findOrFail($id);
        $updateBuilderById->update($request->all());

        return $updateBuilderById;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     *     @OA\Delete(
     *     path="/api/builders/{id}",
     *     tags={"Builders"},
     *     summary="Delete Builder",
     *     description="Delete the specified Builder by id",
     *     @OA\Parameter(
     *         description="Builder id to delete",
     *         in="path",
     *         name="id",
     *         required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     ),
     *     @OA\Response(
     * 			response="405",
     * 			description="Invalid HTTP Method"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Success: successful deleted"
     *     ),
     * )
     */
    public function destroy($id)
    {
        $deleteBikeById = Builder::find($id)->delete();
        return response()->json([], 204);
    }
}
