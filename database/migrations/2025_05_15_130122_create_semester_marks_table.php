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
        Schema::create('semester_marks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mentoring_infos_id');

            // Subject and marks details
            $table->string('subject');
            $table->string('paper_code');
            $table->string('letter_grade')->nullable();
            $table->integer('points')->nullable();
            $table->integer('credit_points')->nullable();

            $table->timestamps();

            // Foreign key constraint
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
        Schema::dropIfExists('semester_marks');
    }
};
