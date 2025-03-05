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
        Schema::create('job_circulers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')->references('id')->on('employers')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('job_title',250);
            $table->string('description',1000);
            $table->string('office_location',255);
            $table->string('area',100);
            $table->boolean('status')->default(0);
            $table->string('circuler_file',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_circulers');
    }
};
