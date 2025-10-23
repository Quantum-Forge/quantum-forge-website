<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Drop unused columns to align with the current model & UI.
     */
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn(['is_featured', 'sort_order', 'meta_title', 'meta_description']);
        });
    }

    /**
     * Restore dropped columns and related indexes.
     */
    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->index(['is_active', 'is_featured']);
            $table->index('sort_order');
        });
    }
};
