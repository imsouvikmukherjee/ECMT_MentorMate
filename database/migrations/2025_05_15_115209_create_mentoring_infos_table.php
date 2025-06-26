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
        Schema::create('mentoring_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('semester_id');
            $table->unsignedBigInteger('user_id');

            // Academic Info
            $table->decimal('sgpa', 4, 2)->nullable(); // Example: 9.25

            // Extra Curriculars
            $table->text('certifications')->nullable();
            $table->text('workshops')->nullable();
            $table->text('competitions')->nullable();
            $table->text('projects')->nullable();
            $table->text('sports_participation')->nullable();
            $table->text('cultural_activities')->nullable();
            $table->text('club_memberships')->nullable();
            $table->text('social_service_activities')->nullable();
            $table->text('community_engagement')->nullable();

            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('session_id')->references('id')->on('academic_sessions')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('department')->onDelete('cascade');
            $table->foreign('semester_id')->references('id')->on('academic_semisters')->onDelete('cascade'); // if you have a semesters table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentoring_infos');
    }
};
