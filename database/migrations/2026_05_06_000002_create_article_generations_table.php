<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('article_generations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('articles')->cascadeOnDelete();

            $table->string('provider')->default('openrouter');
            $table->string('model')->nullable();

            $table->json('input')->nullable();
            $table->longText('prompt')->nullable();

            $table->longText('raw_response')->nullable();
            $table->json('token_usage')->nullable();
            $table->unsignedInteger('latency_ms')->nullable();

            $table->string('status')->default('queued');
            $table->text('error_message')->nullable();

            $table->timestamps();

            $table->index(['provider', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_generations');
    }
};

