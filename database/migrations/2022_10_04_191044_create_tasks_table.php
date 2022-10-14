<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('description');
            $table->enum('category', [\App\Enums\TaskCategoryEnum::toValues()]);
            $table->date('deadline');
            $table->boolean('completed');
            $table->boolean('urgent');
            $table->timestamps();

            // такой индекс нужен для оптимальной выборки с учетом фильтрации по категориям
            $table->index(['user_id', 'category', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
