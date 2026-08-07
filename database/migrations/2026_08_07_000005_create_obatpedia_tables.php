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
        Schema::create('drugs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('generic_name')->nullable();
            $table->text('description')->nullable();
            $table->text('indication')->nullable();
            $table->string('dosage', 255)->nullable();
            $table->string('route', 100)->nullable();
            $table->text('contraindication')->nullable();
            $table->text('side_effects')->nullable();
            $table->timestamps();

            $table->index('name');
            $table->index('generic_name');
        });

        Schema::create('drug_aliases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drug_id')->constrained('drugs')->cascadeOnDelete();
            $table->string('alias');
            $table->timestamps();

            $table->unique(['drug_id', 'alias']);
            $table->index('alias');
        });

        Schema::create('drug_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('drug_id')->constrained('drugs')->cascadeOnDelete();
            $table->tinyInteger('vote');
            $table->timestamps();

            $table->unique(['user_id', 'drug_id']);
            $table->index(['drug_id', 'vote']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drug_votes');
        Schema::dropIfExists('drug_aliases');
        Schema::dropIfExists('drugs');
    }
};
