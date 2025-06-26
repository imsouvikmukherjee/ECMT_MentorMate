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
        Schema::create('communication_pattern2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mentoring_infos_id');
            $table->string('body_language');
            $table->string('type');

            $table->timestamps();

            $table->foreign('mentoring_infos_id')
                  ->references('id')
                  ->on('mentoring_infos')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communication_pattern2');
    }
};
