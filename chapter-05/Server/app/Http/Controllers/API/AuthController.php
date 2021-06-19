<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Users"},
     *     summary="Create new User",
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
     *          description="Success: A Newly Created User",
     *          @OA\Schema(ref="#/definitions/User")
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Success: operation Successfully"
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Refused: Unauthenticated"
     *     ),
     *     @OA\Response(
     *          response="422",
     *          description="Missing mandatory field"
     *     ),
     *     @OA\Response(
     *          response="404",
     *          description="Not Found"
     *   )
     * ),
     */
    public function register(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
     
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = auth()->login($user);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ], 201);
    }

    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Users"},
     *     summary="loggin an user",
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
     *          description="Success: operation Successfully"
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Refused: Unauthenticated"
     *     ),
     *     @OA\Response(
     *          response="422",
     *          description="Missing mandatory field"
     *     ),
     *     @OA\Response(
     *          response="404",
     *          description="Not Found"
     *   )
     * ),
     */
    public function login(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
      
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $current_user = $request->email;
      
        return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'current_user' => $current_user,
        'expires_in' => auth()->factory()->getTTL() * 60
        ], 200);
    }

    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Users"},
     *     summary="logout an user",
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
     *          description="Success: operation Successfully"
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Refused: Unauthenticated"
     *     ),
     *     @OA\Response(
     *          response="422",
     *          description="Missing mandatory field"
     *     ),
     *     @OA\Response(
     *          response="404",
     *          description="Not Found"
     *      ),
	 *      @OA\Response(
	 * 			response="405",
	 * 			description="Invalid input"
	 *      ),
	 *      security={
	 * 		   { "api_key":{} }
	 * 		}
     * ),
     */
    public function logout(Request $request)
    {
      
        auth()->logout(true); // Force token to blacklist
        return response()->json(['success' => 'Logged out Successfully.'], 200);

    }

}
