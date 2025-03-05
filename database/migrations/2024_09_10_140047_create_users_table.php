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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('bdno',10)->unique();
            $table->string('rank',50);
            $table->string('fname',50);
            $table->string('trade',50);
            $table->string('email',50)->unique();
            $table->string('mobile',50);
            $table->string('password',250);
            $table->string('otp',10)->nullable();
            $table->string('profile_image',50)->nullable();
            $table->string('status',50)->default('0');
            $table->string('person_type',50)->default('0');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
