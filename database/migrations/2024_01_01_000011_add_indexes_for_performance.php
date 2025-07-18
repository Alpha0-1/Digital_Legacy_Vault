<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesForPerformance extends Migration
{
    public function up(): void
    {
        Schema::table('vaults', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('security_level');
        });

        Schema::table('legacy_items', function (Blueprint $table) {
            $table->index('vault_id');
            $table->index('item_type');
        });

        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('email');
        });
    }

    public function down(): void
    {
        Schema::table('vaults', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['security_level']);
        });

        Schema::table('legacy_items', function (Blueprint $table) {
            $table->dropIndex(['vault_id']);
            $table->dropIndex(['item_type']);
        });

        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['email']);
        });
    }
}
