<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\Request;
use App\Http\Resources\Tasks\ViewResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Post(
 *     tags={"Tasks"},
 *     path="/api/tasks",
 *     summary="Создать задачу",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(ref="#/components/schemas/TasksRequest")
 *         )
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
 * Class CreateController
 * @package App\Http\Controllers\Tasks
 */
final class CreateController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResource
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Throwable
     */
    public function __invoke(Request $request): JsonResource
    {
        $user = \auth()->user();

        $task = new Task();

        $task->fill([
            'name' => $request->name,
            'user_id' => $user->id,
            'description' => $request->description,
            'category' => $request->category,
            'deadline' => $request->deadline,
            'completed' => false,
            'urgent' => $request->urgent,
        ]);

        $task->saveOrFail();

        $task->addMedia($request->image)->toMediaCollection(Task::MEDIA_COLLECTION_IMAGE);

        return ViewResource::make($task);
    }
}
