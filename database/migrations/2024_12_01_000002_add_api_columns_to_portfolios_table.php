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
        Schema::table('portfolios', function (Blueprint $table) {
            // Add API management columns if they don't exist
            if (!Schema::hasColumn('portfolios', 'name')) {
                $table->string('name')->after('title')->nullable();
            }
            if (!Schema::hasColumn('portfolios', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
            if (!Schema::hasColumn('portfolios', 'api_key')) {
                $table->string('api_key', 255)->unique()->nullable()->after('description');
            }

            // Add indexes
            if (!Schema::hasIndex('portfolios', 'portfolios_is_active_index')) {
                $table->index('is_active');
            }
            if (!Schema::hasIndex('portfolios', 'portfolios_api_key_index')) {
                $table->index('api_key');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn(['name', 'description', 'api_key']);
            $table->dropIndex(['portfolios_is_active_index']);
            $table->dropIndex(['portfolios_api_key_index']);
        });
    }
};
