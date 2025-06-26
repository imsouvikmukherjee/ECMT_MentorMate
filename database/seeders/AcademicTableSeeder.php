<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AcademicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create academic_sessions table if it doesn't exist
        if (!Schema::hasTable('academic_sessions')) {
            Schema::create('academic_sessions', function ($table) {
                $table->id();
                $table->string('name');
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // Add a session record
        DB::table('academic_sessions')->insert([
            'name' => '2023-25',
            'start_date' => '2023-07-01',
            'end_date' => '2025-06-30',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create departments table if it doesn't exist
        if (!Schema::hasTable('departments')) {
            Schema::create('departments', function ($table) {
                $table->id();
                $table->foreignId('academic_session_id')->constrained()->onDelete('cascade');
                $table->string('name');
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        // Add a department record
        DB::table('departments')->insert([
            'academic_session_id' => 1,
            'name' => 'Computer Science',
            'description' => 'Computer Science Department',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
} 