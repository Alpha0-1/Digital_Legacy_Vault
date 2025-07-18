<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegacyReleasesTable extends Migration
{
    public function up(): void
    {
        Schema::create('legacy_releases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('beneficiary_id')->constrained()->onDelete('cascade');
            $table->foreignId('vault_id')->constrained()->onDelete('cascade');
            $table->timestamp('release_date')->nullable();
            $table->string('release_reason');
            $table->enum('status', ['pending', 'processing', 'completed', 'failed'])->default('pending');
            $table->timestamps();
            
            $table->index(['user_id', 'beneficiary_id', 'vault_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('legacy_releases');
    }
}
