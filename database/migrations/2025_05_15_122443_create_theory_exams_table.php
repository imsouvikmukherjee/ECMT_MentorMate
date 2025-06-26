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
        Schema::create('theory_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mentoring_info_id');

            // Subject details
            $table->string('subject_name');
            $table->string('paper_code')->nullable();

            // Continuous Assessment scores
            $table->integer('ca1')->nullable();
            $table->integer('ca2')->nullable();
            $table->integer('ca3')->nullable();
            $table->integer('ca4')->nullable();

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('mentoring_info_id')
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
        Schema::dropIfExists('theory_exams');
    }
};
