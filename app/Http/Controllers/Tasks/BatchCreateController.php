<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\BatchRequest;
use App\Http\Resources\Tasks\ViewResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Post(
 *     tags={"Tasks"},
 *     path="/api/tasks/batch",
 *     summary="Создать несколько задач",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(ref="#/components/schemas/BatchTasksRequest")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(ref="#/components/schemas/TasksViewResource")
 *              )
 *          )
 *     ),
 *     @OA\Response(response="400", ref="#/components/responses/error:bad_request"),
 *     @OA\Response(response="422", ref="#/components/responses/error:validation"),
 *     @OA\Response(response="500", ref="#/components/responses/error:server"),
 *     security={ {"bearer": {}} }
 * )
 *
 * Class BatchCreateController
 * @package App\Http\Controllers\Tasks
 */
final class BatchCreateController extends Controller
{
    /**
     * @param BatchRequest $request
     *
     * @return AnonymousResourceCollection
     *
     * @throws \Throwable
     */
    public function __invoke(BatchRequest $request): AnonymousResourceCollection
    {
        $user = \auth()->user();

        $result = [];

        DB::transaction(static function () use ($user, $request, &$result) {
            foreach ($request->data as $taskData) {
                $task = new Task();

                $task->fill([
                    'name' => $taskData['name'],
                    'user_id' => $user->id,
                    'description' => $taskData['description'],
                    'category' => $taskData['category'],
                    'deadline' => $taskData['deadline'],
                    'completed' => false,
                    'urgent' => $taskData['urgent'],
                ]);

                $task->saveOrFail();

                $task->addMedia($taskData['image'])->toMediaCollection(Task::MEDIA_COLLECTION_IMAGE);

                $result[] = $task;
            }
        });

        return ViewResource::collection($result);
    }
}
