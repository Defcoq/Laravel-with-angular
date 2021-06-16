<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


/**
 * Class ApiController
 *
 * @package App\Http\Controllers
 *
 * @OA\Swagger(
 *     basePath="",
 *     host="localhost:8081",
 *     schemes={"http"},
 *     @OA\Info(
 *         version="1.0",
 *         title="Custom Bikes",
 *         @OA\Contact(name="Developer Contact", url="https://www.example.com"),
 *     )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
