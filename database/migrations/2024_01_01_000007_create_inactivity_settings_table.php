<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInactivitySettingsTable extends Migration
{
    public function up()
    {
        Schema::create('inactivity_settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('threshold_days')->default(90);
            $table->timestamp('last_activity_at')->default(now());
            $table->enum('release_status', ['pending', 'released', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inactivity_settings');
    }
}
