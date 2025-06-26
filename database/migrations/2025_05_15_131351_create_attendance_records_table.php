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
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mentoring_infos_id');
            $table->string('subject');

            // Monthly attendance columns
            $table->integer('jan')->nullable();
            $table->integer('feb')->nullable();
            $table->integer('mar')->nullable();
            $table->integer('apr')->nullable();
            $table->integer('may')->nullable();
            $table->integer('jun')->nullable();
            $table->integer('jul')->nullable();
            $table->integer('aug')->nullable();
            $table->integer('sep')->nullable();
            $table->integer('oct')->nullable();
            $table->integer('nov')->nullable();
            $table->integer('dec')->nullable();

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
        Schema::dropIfExists('attendance_records');
    }
};
