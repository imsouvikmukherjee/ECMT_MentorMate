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
        Schema::create('practical_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mentoring_infos_id');

            // Subject details
            $table->string('subject_name');
            $table->string('paper_code')->nullable();

            // Practical Continuous Assessments
            $table->integer('pca1')->nullable();
            $table->integer('pca2')->nullable();

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
        Schema::dropIfExists('practical_exams');
    }
};
