<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariesTable extends Migration
{
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('relationship');
            $table->json('notification_preference')->default(json_encode(['email']));
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
            
            $table->unique(['user_id', 'email']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('beneficiaries');
    }
}
