<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'api_key')) {
                $table->string('api_key', 36)->nullable()->unique()->after('password');
            }
            if (! Schema::hasColumn('users', 'api_key_created_at')) {
                $table->timestamp('api_key_created_at')->nullable()->after('api_key');
            }
            if (! Schema::hasColumn('users', 'selected_portfolio_ids')) {
                $table->json('selected_portfolio_ids')->nullable()->after('api_key_created_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'selected_portfolio_ids')) {
                $table->dropColumn('selected_portfolio_ids');
            }
            if (Schema::hasColumn('users', 'api_key_created_at')) {
                $table->dropColumn('api_key_created_at');
            }
            if (Schema::hasColumn('users', 'api_key')) {
                $table->dropUnique(['api_key']);
                $table->dropColumn('api_key');
            }
        });
    }
};