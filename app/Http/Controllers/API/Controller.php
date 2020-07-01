<?php

namespace App\Http\Controllers\API;

/**
 * @OA\Info(
 *     title="Library Swagger API documentation",
 *     version="1.0.0",
 *     @OA\Contact(
 *         email="igornosatov@example.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\Tag(
 *     name="Books",
 * )
 * @OA\Server(
 *     description="Laravel Library Swagger API server",
 *     url="http://localhost:8000/api"
 * )
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     name="X-APP-ID",
 *     securityScheme="X-APP-ID"
 * )
 */

class Controller extends \App\Http\Controllers\Controller
{
}