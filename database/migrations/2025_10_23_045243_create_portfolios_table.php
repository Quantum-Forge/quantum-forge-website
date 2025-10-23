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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('date');
            $table->string('clients');
            $table->string('category');
            $table->string('kota');
            $table->text('description_proyek');
            $table->string('link')->nullable();
            $table->string('images1')->nullable();
            $table->string('heading');
            $table->text('description2');
            $table->string('images2')->nullable();
            $table->string('images3')->nullable();
            $table->string('images4')->nullable();
            
            // Field tambahan untuk admin panel
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->string('slug')->unique();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('tags')->nullable();
            
            // Kolom untuk audit trail
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            
            // Indexes untuk performa
            $table->index(['is_active', 'is_featured']);
            $table->index('sort_order');
            $table->index('category');
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
