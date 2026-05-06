<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('topic');
            $table->string('title');
            $table->string('slug')->unique();

            $table->string('tone')->nullable();
            $table->json('keywords')->nullable();

            $table->text('image_prompt')->nullable();
            $table->text('featured_image_url')->nullable();

            $table->longText('markdown')->nullable();
            $table->longText('html')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->string('status')->default('draft');
            $table->timestamp('generated_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->text('failure_reason')->nullable();

            $table->timestamps();

            $table->index(['status', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

