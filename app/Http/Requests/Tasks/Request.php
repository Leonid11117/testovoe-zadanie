<?php

declare(strict_types=1);

namespace App\Http\Requests\Tasks;

use App\Enums\TaskCategoryEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;

/**
 * Class Request
 *
 * @OA\Schema(
 *     schema="TasksRequest",
 *     required={"name", "description", "category", "deadline", "urgent", "image"},
 *     @OA\Property(property="name", type="string", example="test"),
 *     @OA\Property(property="description", type="string", example="test"),
 *     @OA\Property(property="category", type="string", example="work", enum={"work", "personal"}),
 *     @OA\Property(property="deadline", type="string", format="date", example="2022-10-05"),
 *     @OA\Property(property="urgent", type="boolean", example="false"),
 *     @OA\Property(property="image", type="string", format="binary"),
 * )
 *
 * @property string $name
 * @property string $description
 * @property string $category
 * @property string $deadline
 * @property string $urgent
 * @property UploadedFile $image
 *
 * @package App\Http\Requests\Tasks
 */
final class Request extends FormRequest
{
    public function rules(): array
    {
        $maxImageSize = \config('media-library.max_file_size');

        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:65535'],
            'category' => ['required', 'string', Rule::in(TaskCategoryEnum::toValues())],
            'deadline' => ['required', 'date', 'after:now'],
            'urgent' => ['required', 'boolean'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:' . $maxImageSize],
        ];
    }
}
