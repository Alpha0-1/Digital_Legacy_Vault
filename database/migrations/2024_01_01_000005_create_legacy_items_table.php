<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegacyItemsTable extends Migration
{
    public function up()
    {
        Schema::create('legacy_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vault_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->string('item_type');
            $table->text('access_instructions')->nullable();
            $table->timestamps();
            
            $table->index('vault_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('legacy_items');
    }
}
