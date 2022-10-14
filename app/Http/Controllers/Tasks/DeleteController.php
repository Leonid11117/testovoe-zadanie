<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * @OA\Delete(
 *     tags={"Tasks"},
 *     path="/api/tasks/{id}",
 *     summary="Удалить задачу",
 *     @OA\Parameter(
 *         name="id",
 *         required=true,
 *         example="1",
 *         in="path"
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="No content",
 *     ),
 *     @OA\Response(response="400", ref="#/components/responses/error:bad_request"),
 *     @OA\Response(response="422", ref="#/components/responses/error:validation"),
 *     @OA\Response(response="500", ref="#/components/responses/error:server"),
 *     security={ {"bearer": {}} }
 * )
 *
 * Class DeleteController
 * @package App\Http\Controllers\Tasks
 */
final class DeleteController extends Controller
{
    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        $user = \auth()->user();

        $task = Task::query()
            ->where('id', '=', $id)
            ->where('user_id', '=', $user->id)
            ->firstOrFail()
        ;

        $task->delete();

        return \response()->json([], Response::HTTP_NO_CONTENT);
    }
}
