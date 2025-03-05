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
        Schema::create('baf_circulars', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('file_url', 200);
            $table->string('subject', 200);
            $table->date('published_on');
            $table->string('remarks', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baf_circulars');
    }
};
