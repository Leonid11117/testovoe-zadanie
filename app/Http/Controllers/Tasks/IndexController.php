<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tasks\IndexResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @OA\Get(
 *     tags={"Tasks"},
 *     path="/api/tasks",
 *     summary="Список задач",
 *     @OA\Parameter(
 *         name="filter[category]",
 *         example="work",
 *         in="query",
 *         allowReserved={"work", "personal"}
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="array",
 *                  @OA\Items(ref="#/components/schemas/TasksViewResource")
 *              ),
 *              @OA\Property(
 *                  property="links",
 *                  type="object",
 *                  ref="#/components/schemas/PaginatedLinksResource"
 *              ),
 *              @OA\Property(
 *                  property="meta",
 *                  type="object",
 *                  ref="#/components/schemas/PaginatedMetaResource"
 *              ),
 *          )
 *     ),
 *     @OA\Response(response="500", ref="#/components/responses/error:server"),
 *     security={ {"bearer": {}} }
 * )
 *
 * Class IndexController
 * @package App\Http\Controllers\Tasks
 */
final class IndexController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function __invoke(): AnonymousResourceCollection
    {
        $user = \auth()->user();

        $tasks = QueryBuilder::for(Task::class)
            ->where('user_id', '=', $user->id)
            ->orderByDesc('created_at')
            ->allowedFilters(['category'])
            ->paginate()
        ;

        return IndexResource::collection($tasks);
    }
}
