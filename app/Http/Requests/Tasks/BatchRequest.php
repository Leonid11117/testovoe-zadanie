<?php

declare(strict_types=1);

namespace App\Http\Requests\Tasks;

use App\Enums\TaskCategoryEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class BatchRequest
 *
 * @OA\Schema(
 *     schema="BatchTasksRequest",
 *     required={"data"},
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(
 *             required={"name", "description", "category", "deadline", "urgent", "image"},
 *             @OA\Property(property="name", type="string", example="test"),
 *             @OA\Property(property="description", type="string", example="test"),
 *             @OA\Property(property="category", type="string", example="work", enum={"work", "personal"}),
 *             @OA\Property(property="deadline", type="string", format="date", example="2022-10-05"),
 *             @OA\Property(property="urgent", type="boolean", example="false"),
 *             @OA\Property(property="image", type="string", format="binary"),
 *         )
 *     ),
 * )
 *
 * @property array $data
 *
 * @package App\Http\Requests\Tasks
 */
final class BatchRequest extends FormRequest
{
    public function rules(): array
    {
        $maxImageSize = \config('media-library.max_file_size');

        return [
            'data.*.name' => ['required', 'string', 'max:255'],
            'data.*.description' => ['required', 'string', 'max:65535'],
            'data.*.category' => ['required', 'string', Rule::in(TaskCategoryEnum::toValues())],
            'data.*.deadline' => ['required', 'date', 'after:now'],
            'data.*.urgent' => ['required', 'boolean'],
            'data.*.image' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:' . $maxImageSize],
        ];
    }
}
