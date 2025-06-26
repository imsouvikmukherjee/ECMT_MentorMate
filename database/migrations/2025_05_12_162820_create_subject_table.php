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
        Schema::create('subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('semester_id');
            $table->string('subject_name');
            $table->string('subject_code');
            $table->enum('subject_type', ['theory', 'practical']);
            $table->integer('marks');
            $table->timestamps();

            $table->foreign('session_id')->references('id')->on('academic_sessions')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('department')->onDelete('cascade');
            $table->foreign('semester_id')->references('id')->on('academic_semisters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject');
    }
};
