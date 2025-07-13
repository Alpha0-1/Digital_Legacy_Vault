<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaultsTable extends Migration
{
    public function up()
    {
        Schema::create('vaults', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('encryption_key')->nullable(); // For master encryption key
            $table->text('content'); // Encrypted content
            $table->enum('security_level', ['low', 'medium', 'high'])->default('high');
            $table->timestamp('locked_at')->nullable(); // For future lock functionality
            $table->timestamps();
            
            // Index for faster queries
            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vaults');
    }
}
