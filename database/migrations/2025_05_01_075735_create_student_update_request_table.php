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
        Schema::create('student_update_request', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid');
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->date('dob');
            $table->string('nationality');
            $table->string('category');
            $table->string('sex');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('blood_group');
            $table->string('religion');
            $table->string('aadhaar_no');
            $table->text('student_address');
            $table->string('alternate_mobile');
            $table->string('state');
            $table->string('district');
            $table->string('pin');
            $table->string('contact'); // primary_mobile
            $table->string('guardian_name');
            $table->string('guardian_mobile');
            $table->text('guardian_address');
            $table->string('relation_with_guardian');
            $table->string('residence_status');
            $table->string('session');
            $table->string('reg_no');
            $table->string('roll_no');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_update_request');
    }
};
