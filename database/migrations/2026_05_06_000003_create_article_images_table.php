<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('article_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('articles')->cascadeOnDelete();

            $table->string('provider')->default('pollinations');
            $table->text('prompt');
            $table->text('url');

            $table->timestamps();

            $table->index(['article_id', 'provider']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_images');
    }
};

