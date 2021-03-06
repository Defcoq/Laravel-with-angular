<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/items",
     *     tags={"Items"},
     *     summary="List Items",
     *     @OA\Response(
     *          response=200,
     *          description="Success: List all Items",
     *          @OA\Schema(ref="#/definitions/Item")
     *      ),
     *     @OA\Response(
	 * 			response="405",
	 * 			description="Invalid HTTP Method"
	 *     ),
     *     @OA\Response(
     *          response="404",
     *          description="Not Found"
     *   )
     * ),
     */
    public function index()
    {
        $listItems = Item::all();
        return $listItems;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *     path="/api/items",
     *     tags={"Items"},
     *     summary="Create Item",
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
     *          description="Success: A Newly Created Item",
     *          @OA\Schema(ref="#/definitions/Item")
     *      ),
     *     @OA\Response(
     *          response="422",
     *          description="Missing mandatory field"
     *     ),
     *     @OA\Response(
	 * 			response="405",
	 * 			description="Invalid HTTP Method"
	 *     ),
     *     @OA\Response(
     *          response="404",
     *          description="Not Found"
     *   )
     * ),
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'name' => 'required',            
            'company'=> 'required',
            'bike_id'=> 'required'
            ]);
            
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);    
        }
        $createItem = Item::create($request->all());
        return  $createItem;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/items/{id}",
     *     tags={"Items"},
     *     summary="Get Item by Id",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *          description="Display the specified Item by id.",
     * 		),
     *     @OA\Response(
     *          response=200,
     *          description="Success: Return the Item",
     *          @OA\Schema(ref="#/definitions/Item")
     *      ),
     *     @OA\Response(
	 * 			response="405",
	 * 			description="Invalid HTTP Method"
	 *     ),
     *     @OA\Response(
     *          response="404",
     *          description="Not Found"
     *   )
     * ),
     */
    public function show($id)
    {
        $showItemById = Item::findOrFail($id);
        return $showItemById;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Put(
     *     path="/api/items/{id}",
     *     tags={"Items"},
     *     summary="Update Item",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *          description="Update the specified Item by id.",
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
     *          description="Success: Return the Item updated",
     *          @OA\Schema(ref="#/definitions/Item")
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
        $updateItemById = Item::findOrFail($id);
        $updateItemById->update($request->all());

        return $updateItemById;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     *     @OA\Delete(
     *     path="/api/items/{id}",
     *     tags={"Items"},
     *     summary="Delete Item",
     *     description="Delete the specified Item by id",
     *     @OA\Parameter(
     *         description="Item id to delete",
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
        $deleteItemById = Item::find($id)->delete();
        return response()->json([], 204);
    }
}
