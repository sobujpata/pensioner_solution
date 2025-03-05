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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('fname',50);
            $table->string('org_name',250);
            $table->string('designation',50);
            $table->string('email',50)->unique();
            $table->string('mobile',50);
            $table->string('password',250);
            $table->string('otp',10)->nullable();
            $table->string('status',1)->default('0');
            $table->string('image_url',210);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employers');
    }
};
