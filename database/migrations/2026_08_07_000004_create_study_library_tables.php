<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('study_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('study_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('study_categories')->restrictOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('resource_type', 20);
            $table->text('resource_url');
            $table->string('thumbnail')->nullable();
            $table->timestamps();

            $table->index('category_id');
            $table->index('resource_type');
        });

        Schema::create('study_material_progresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('study_material_id')->constrained('study_materials')->cascadeOnDelete();
            $table->string('status', 20)->default('pending');
            $table->timestamps();

            $table->unique(['user_id', 'study_material_id']);
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_material_progresses');
        Schema::dropIfExists('study_materials');
        Schema::dropIfExists('study_categories');
    }
};
