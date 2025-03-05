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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unique('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->date('dob')->nullable();
            $table->string('nid', 20)->nullable();
            $table->string('vill', 50)->nullable();
            $table->string('po', 50)->nullable();
            $table->string('ps', 50)->nullable();
            $table->string('district', 50)->nullable();
            $table->string('division', 50)->nullable();
            $table->string('present_address', 250)->nullable();
            $table->string('qualification', 50)->nullable();
            $table->string('passingyear', 50)->nullable();
            $table->string('jobchoice', 50)->nullable();
            $table->string('jobarea', 50)->nullable();
            $table->string('experience', 250)->nullable();
            $table->string('resume', 150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
