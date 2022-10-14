<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title=L5_SWAGGER_APP_NAME,
 *      description="Test API",
 * )
 *
 * @OA\OpenApi()
 *
 * @OA\Server(
 *     description="Описание",
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API"
 * )
 *
 * @OA\Response(
 *     response="error:not_found",
 *     description="Данные не найдены",
 *     @OA\JsonContent(
 *         @OA\Property(
 *              property="message",
 *              type="string",
 *              description="Текст ошибки",
 *              example="messages.exception.not_found"
 *         ),
 *    ),
 * )
 *
 * @OA\Response(
 *     response="error:gone",
 *     description="Gone",
 *     @OA\JsonContent(
 *         @OA\Property(
 *              property="message",
 *              type="string",
 *              description="Текст ошибки",
 *              example="messages.exception.gone"
 *         ),
 *    ),
 * )
 *
 * @OA\Response(
 *     response="error:bad_request",
 *     description="Bad request",
 *     @OA\JsonContent(
 *         @OA\Property(
 *              property="message",
 *              type="string",
 *              description="Текст ошибки",
 *              example="messages.exception.bad_request"
 *         ),
 *    ),
 * )
 *
 * @OA\Response(
 *     response="error:unauthenticated",
 *     description="Unauthenticated",
 *     @OA\JsonContent(
 *         @OA\Property(
 *              property="message",
 *              type="string",
 *              description="Текст ошибки",
 *              example="messages.exception.unauthenticated"
 *         ),
 *    ),
 * )
 *
 * @OA\Response(
 *     response="error:server",
 *     description="Internal server error",
 *     @OA\JsonContent(
 *         @OA\Property(
 *              property="message",
 *              type="string",
 *              description="Текст ошибки",
 *              example="messages.exception.server"
 *         ),
 *    ),
 * )
 *
 * @OA\Response(
 *     response="error:too_many_requests",
 *     description="Too many requests",
 *     @OA\JsonContent(
 *         @OA\Property(
 *              property="message",
 *              type="string",
 *              description="Текст ошибки",
 *              example="messages.exception.too_many_requests"
 *         ),
 *    ),
 * )
 *
 * @OA\Response(
 *     response="error:validation",
 *     description="Data validation failed",
 *     @OA\JsonContent(
 *         @OA\Property(
 *              property="message",
 *              type="string",
 *              example="messages.exception.given_data_invalid"
 *         ),
 *         @OA\Property(
 *              property="errors",
 *              type="object",
 *              @OA\Property(
 *                  property="field",
 *                  type="string",
 *                  example="Field is required"
 *              ),
 *         ),
 *    ),
 * )
 *
 * @OA\Schema(
 *     schema="PaginatedLinksResource",
 *     @OA\Property(property="first", type="string", format="uri", nullable=true, example="http://test.dok/api/tasks?page=1"),
 *     @OA\Property(property="last", type="string", format="uri", nullable=true, example="http://test.dok/api/tasks?page=4"),
 *     @OA\Property(property="prev", type="string", format="uri", nullable=true, example="null"),
 *     @OA\Property(property="next", type="string", format="uri", nullable=true, example="http://test.dok/api/tasks?page=2"),
 * )
 *
 * @OA\Schema(
 *     schema="PaginatedMetaResource",
 *     @OA\Property(property="current_page", type="integer", example="1"),
 *     @OA\Property(property="from", type="integer", example="1"),
 *     @OA\Property(property="last_page", type="integer", example="4"),
 *     @OA\Property(property="links", type="array", @OA\Items(ref="#/components/schemas/PaginatedMetaLinksResource")),
 *     @OA\Property(property="path", type="string", format="uri", example="http://test.dok/api/tasks"),
 *     @OA\Property(property="per_page", type="integer", example="15"),
 *     @OA\Property(property="to", type="integer", example="15"),
 *     @OA\Property(property="total", type="integer", example="48"),
 * )
 *
 * @OA\Schema(
 *     schema="PaginatedMetaLinksResource",
 *     @OA\Property(property="url", type="string", format="uri", nullable=true, example="null"),
 *     @OA\Property(property="label", type="string", format="uri", example="&laquo; Previous"),
 *     @OA\Property(property="active", type="boolean", example="false"),
 * )
 *
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

//"meta": {
//    "current_page": 1
//        "from": 1
//        "last_page": 4
//        "links": [
//            {
//                "url": null,
//                "label": "&laquo; Previous",
//                "active": false
//            },
//        ],
//        "path": "http://test.dok/api/tasks",
//        "per_page": 15
//        "to": 15
//        "total": 48
//    }
