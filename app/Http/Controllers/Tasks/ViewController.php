<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tasks\ViewResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Get(
 *     tags={"Tasks"},
 *     path="/api/tasks/{id}",
 *     summary="Просмотреть задачу",
 *     @OA\Parameter(
 *         name="id",
 *         required=true,
 *         example="1",
 *         in="path"
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  ref="#/components/schemas/TasksViewResource",
 *              )
 *          )
 *     ),
 *     @OA\Response(response="400", ref="#/components/responses/error:bad_request"),
 *     @OA\Response(response="422", ref="#/components/responses/error:validation"),
 *     @OA\Response(response="500", ref="#/components/responses/error:server"),
 *     security={ {"bearer": {}} }
 * )
 *
 * Class ViewController
 * @package App\Http\Controllers\Tasks
 */
final class ViewController extends Controller
{
    public function __invoke(int $id): JsonResource
    {
        $user = \auth()->user();

        $task = Task::query()
            ->where('id', '=', $id)
            ->where('user_id', '=', $user->id)
            ->firstOrFail()
        ;

        return ViewResource::make($task);
    }
}
