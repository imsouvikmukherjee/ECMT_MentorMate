<?php

namespace Database\Seeders;

use App\Models\AcademicSession;
use App\Models\Department;
use App\Models\Semester;
use Illuminate\Database\Seeder;

class AcademicDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Academic Sessions
        $session = AcademicSession::create([
            'name' => '2023-2024',
            'description' => 'Academic year 2023-2024',
            'is_active' => true
        ]);

        // Create Departments
        $department = Department::create([
            'academic_session_id' => $session->id,
            'name' => 'Computer Science',
            'description' => 'Department of Computer Science',
            'is_active' => true
        ]);

        // Create Semesters
        Semester::create([
            'department_id' => $department->id,
            'type' => 'odd',
            'months' => ['July', 'August', 'September', 'October', 'November', 'December'],
            'is_active' => true
        ]);

        Semester::create([
            'department_id' => $department->id,
            'type' => 'even',
            'months' => ['January', 'February', 'March', 'April', 'May', 'June'],
            'is_active' => true
        ]);
    }
} 