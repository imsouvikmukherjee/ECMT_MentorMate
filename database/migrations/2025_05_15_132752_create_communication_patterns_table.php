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
        Schema::create('communication_patterns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mentoring_infos_id');
            $table->string('language');
            $table->string('proficiency'); // You can use enum if proficiency levels are predefined

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
        Schema::dropIfExists('communication_patterns');
    }
};
