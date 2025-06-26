<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentDetail;
use App\Models\StudentCertification;
use App\Models\StudentWorkshop;
use App\Models\StudentInternship;
use App\Models\StudentChallenge;
use App\Models\MentorFeedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class MentoringController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $student = StudentDetail::where('user_id', $user->id)->first();
        
        if (!$student) {
            return redirect()->route('user.mentoring')->with('error', 'Student profile not found.');
        }

        // Get the mentor info
        $mentor = DB::table('assigned_mentor')
            ->select('users.name as mentor_name', 'users.email as mentor_email', 'users.contact as mentor_contact', 'users.id as mentor_id')
            ->join('users', 'assigned_mentor.mentor_id', '=', 'users.id')
            ->where('assigned_mentor.mentee_id', $student->id)
            ->first();

        // Get semester data
        $semesterData = [];
        $semesterSubjects = [];
        
        if(Schema::hasTable('student_semester_data')) {
            for($i = 1; $i <= 8; $i++) {
                // Set default value for $data to avoid unassigned variable error
                $data = null;
                $data = DB::table('student_semester_data')
                    ->where('student_id', $student->id)
                    ->where('semester', $i)
                    ->first();
                
                $semesterData[$i] = $data;
                
                if($data && !empty($data->subjects)) {
                    // Convert JSON subjects to array of objects
                    $subjects = json_decode($data->subjects);
                    $semesterSubjects[$i] = $subjects;
                } else {
                    $semesterSubjects[$i] = [];
                }
            }
        } else {
            Log::warning('student_semester_data table does not exist');
        }

        // Fetch all related data
        $certifications = StudentCertification::where('student_id', $student->id)
            ->orderBy('semester')
            ->get()
            ->groupBy('semester');
            
        $workshops = StudentWorkshop::where('student_id', $student->id)
            ->orderBy('semester')
            ->get()
            ->groupBy('semester');
            
        $internships = StudentInternship::where('student_id', $student->id)
            ->orderBy('semester')
            ->get()
            ->groupBy('semester');
            
        $challenges = StudentChallenge::where('student_id', $student->id)
            ->orderBy('semester')
            ->get()
            ->groupBy('semester');
            
        // Get mentor feedback only if table exists
        $mentorFeedback = [];
        if (Schema::hasTable('mentor_feedbacks')) {
            try {
                $mentorFeedback = MentorFeedback::where('student_id', $student->id)
                    ->orderBy('semester')
                    ->get()
                    ->groupBy('semester');
            } catch (\Exception $e) {
                Log::error('Error getting mentor feedback: ' . $e->getMessage());
            }
        }

        return view('student.edit-mentoring', compact(
            'student',
            'mentor',
            'semesterData',
            'semesterSubjects',
            'certifications',
            'workshops',
            'internships',
            'challenges',
            'mentorFeedback'
        ));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $student = StudentDetail::where('user_id', $user->id)->first();
        
        if (!$student) {
            return redirect()->route('user.mentoring.edit')->with('error', 'Student profile not found.');
        }

        // Get mentor ID
        $mentor = DB::table('assigned_mentor')
            ->where('mentee_id', $student->id)
            ->first();

        if (!$mentor) {
            return redirect()->route('user.mentoring.edit')->with('error', 'Mentor not assigned.');
        }

        // Process each semester's data
        $semesters = $request->input('semesters', []);
        
        foreach ($semesters as $semesterNum => $semesterData) {
            // Process subjects
            if (isset($semesterData['subjects'])) {
                $this->processSemesterSubjects($student->id, $semesterNum, $semesterData['subjects']);
            }
            
            // Process certifications
            if (isset($semesterData['certifications'])) {
                $this->processCertifications($student->id, $semesterNum, $semesterData['certifications']);
            }
            
            // Process workshops
            if (isset($semesterData['workshops'])) {
                $this->processWorkshops($student->id, $semesterNum, $semesterData['workshops']);
            }
            
            // Process internships
            if (isset($semesterData['internships'])) {
                $this->processInternships($student->id, $semesterNum, $semesterData['internships']);
            }
            
            // Process challenges
            if (isset($semesterData['challenges'])) {
                $this->processChallenges($student->id, $semesterNum, $semesterData['challenges']);
            }
        }

        return redirect()->route('user.mentoring')->with('success', 'Mentoring information updated successfully.');
    }

    /**
     * Process semester subjects data
     */
    private function processSemesterSubjects($studentId, $semester, $subjects)
    {
        // Filter out empty subjects
        $filteredSubjects = array_filter($subjects, function($subject) {
            return !empty($subject['name']);
        });
        
        if (empty($filteredSubjects)) {
            return;
        }

        // Create or update semester data
        DB::table('student_semester_data')
            ->updateOrInsert(
                ['student_id' => $studentId, 'semester' => $semester],
                ['subjects' => json_encode(array_values($filteredSubjects)), 'updated_at' => now()]
            );
    }

    /**
     * Process certifications data
     */
    private function processCertifications($studentId, $semester, $certifications)
    {
        // Delete existing certifications for this semester
        StudentCertification::where('student_id', $studentId)
            ->where('semester', $semester)
            ->delete();
        
        // Add new certifications
        foreach ($certifications as $cert) {
            if (empty($cert['title'])) {
                continue;
            }
            
            StudentCertification::create([
                'student_id' => $studentId,
                'semester' => $semester,
                'title' => $cert['title'],
                'issuer' => $cert['issuer'] ?? '',
                'completion_date' => $cert['completion_date'] ?? null
            ]);
        }
    }

    /**
     * Process workshops data
     */
    private function processWorkshops($studentId, $semester, $workshops)
    {
        // Delete existing workshops for this semester
        StudentWorkshop::where('student_id', $studentId)
            ->where('semester', $semester)
            ->delete();
        
        // Add new workshops
        foreach ($workshops as $workshop) {
            if (empty($workshop['name'])) {
                continue;
            }
            
            StudentWorkshop::create([
                'student_id' => $studentId,
                'semester' => $semester,
                'name' => $workshop['name'],
                'organizer' => $workshop['organizer'] ?? '',
                'date' => $workshop['date'] ?? null
            ]);
        }
    }

    /**
     * Process internships data
     */
    private function processInternships($studentId, $semester, $internships)
    {
        // Delete existing internships for this semester
        StudentInternship::where('student_id', $studentId)
            ->where('semester', $semester)
            ->delete();
        
        // Add new internships
        foreach ($internships as $internship) {
            if (empty($internship['company'])) {
                continue;
            }
            
            StudentInternship::create([
                'student_id' => $studentId,
                'semester' => $semester,
                'company' => $internship['company'],
                'role' => $internship['role'] ?? '',
                'duration' => $internship['duration'] ?? '',
                'work_done' => $internship['work_done'] ?? ''
            ]);
        }
    }

    /**
     * Process challenges data
     */
    private function processChallenges($studentId, $semester, $challenges)
    {
        // Delete existing challenges for this semester
        StudentChallenge::where('student_id', $studentId)
            ->where('semester', $semester)
            ->delete();
        
        // Add new challenges
        foreach ($challenges as $challenge) {
            if (empty($challenge['name'])) {
                continue;
            }
            
            StudentChallenge::create([
                'student_id' => $studentId,
                'semester' => $semester,
                'name' => $challenge['name'],
                'description' => $challenge['description'] ?? '',
                'result' => $challenge['result'] ?? ''
            ]);
        }
    }
} 