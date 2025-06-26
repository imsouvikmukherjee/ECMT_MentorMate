<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\StudentDetail;
use App\Models\StudentSubject;
use Illuminate\Support\Facades\Session;

class SubjectController extends Controller
{
    public function subject(){

        $subjects = DB::table('subject')
        ->join('academic_sessions', 'subject.session_id', '=', 'academic_sessions.id')
        ->join('department', 'subject.department_id', '=', 'department.id')
        ->join('academic_semisters', 'subject.semester_id', '=', 'academic_semisters.id')
        ->select(
            'subject.id',
            'academic_sessions.session',
            'department.department_name',
            'academic_semisters.semister_name as semester_name',
            'subject.subject_name',
            'subject.subject_code',
            'subject.subject_type',
            'subject.marks'
        )
        ->orderBy('subject.id', 'desc')
        ->get();

          $mentee_id = DB::table('assigned_mentor')
        ->join('student_details','assigned_mentor.mentee_id','=','student_details.id')
        ->join('users','student_details.user_id','=','users.id')
        ->select('users.id')
        ->where('assigned_mentor.mentor_id',Session::get('userid'))
         ->pluck('users.id');

 $pendingMentoringCount = DB::table('mentoring_infos')
    ->where('mentoring_infos.status', '0')
    ->whereIn('mentoring_infos.user_id', $mentee_id)
    ->count();



$pendingUpdateRequestCount = DB::table('student_update_request')
    ->where('status', 0)
    ->whereIn('userid', function($query) {
        $query->select('student_details.user_id')
              ->from('assigned_mentor')
              ->join('student_details', 'assigned_mentor.mentee_id', '=', 'student_details.id')
              ->where('assigned_mentor.mentor_id', Session::get('userid'));
    })
    ->count();

        return view('admin.subjects', ['pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount, 'subjects' => $subjects]);
    }


    public function subjectDelete($id){
        $id = decrypt($id);
        DB::table('subject')->where('id',$id)->delete();
        return redirect()->back()->with('success','Subject deleted successfully');
    }

    public function addSubject(){
        $sessions = DB::table('academic_sessions')->orderBy('id','desc')->get();

          $mentee_id = DB::table('assigned_mentor')
        ->join('student_details','assigned_mentor.mentee_id','=','student_details.id')
        ->join('users','student_details.user_id','=','users.id')
        ->select('users.id')
        ->where('assigned_mentor.mentor_id',Session::get('userid'))
         ->pluck('users.id');

 $pendingMentoringCount = DB::table('mentoring_infos')
    ->where('mentoring_infos.status', '0')
    ->whereIn('mentoring_infos.user_id', $mentee_id)
    ->count();



$pendingUpdateRequestCount = DB::table('student_update_request')
    ->where('status', 0)
    ->whereIn('userid', function($query) {
        $query->select('student_details.user_id')
              ->from('assigned_mentor')
              ->join('student_details', 'assigned_mentor.mentee_id', '=', 'student_details.id')
              ->where('assigned_mentor.mentor_id', Session::get('userid'));
    })
    ->count();

        return view('admin.add-subject', ['pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount,'sessions' => $sessions]);
    }


    public function getDepartments(Request $request)
{
    $departments = DB::table('department')
        ->where('session_id', $request->session_id)
        ->get();

    return response()->json($departments);
}

public function getSemesters(Request $request)
{
    $semesters = DB::table('academic_semisters')
        ->where('session_id', $request->session_id)
        ->where('department_id', $request->department_id)
        ->orderBy('id', 'desc')
        ->get();

    return response()->json($semesters);
}

    public function addSubjectStore(Request $request){


        $request->validate([
            'session' => 'required|exists:academic_sessions,id',
            'department' => 'required|exists:department,id',
            'semester' => 'required|exists:academic_semisters,id',
            'subject_name' => 'required|string|max:255',
            'subject_code' => 'required|string|max:50',
            'subject_type' => 'required|in:theory,practical',
            'marks' => 'required|integer|min:1|max:100',
        ]);

            // $exists = DB::table('subject')
            // ->where('session_id', $request->session)
            // ->where('department_id', $request->department)
            // ->where('semester_id', $request->semester)
            // ->where(function ($query) use ($request) {
            //     $query->where('subject_name', $request->subject_name)
            //         ->orWhere('subject_code', strtoupper($request->subject_code));
            // })
            // ->exists();

            $exists = DB::table('subject')
    ->where('session_id', $request->session)
    ->where('department_id', $request->department)
    ->where('semester_id', $request->semester)
    ->where('subject_code', strtoupper($request->subject_code))
    ->exists();


        if ($exists) {
            return back()
                ->withErrors(['subject_name' => 'Subject name or code already exists for the selected session, department, and semester.'])
                ->withInput();
        }

        DB::table('subject')->insert([
            'session_id' => $request->session,
            'department_id' => $request->department,
            'semester_id' => $request->semester,
            'subject_name' => $request->subject_name,
            'subject_code' => strtoupper($request->subject_code),
            'subject_type' => $request->subject_type,
            'marks' => $request->marks,
            'created_at' => now(),

        ]);


        return redirect()->route('subject')
            ->with('success', 'Subject added successfully!');
    }

    public function assignSubjects() {
        $departments = DB::table('department')->orderBy('department_name', 'asc')->get();
        $subjects = [];

         $mentee_id = DB::table('assigned_mentor')
        ->join('student_details','assigned_mentor.mentee_id','=','student_details.id')
        ->join('users','student_details.user_id','=','users.id')
        ->select('users.id')
        ->where('assigned_mentor.mentor_id',Session::get('userid'))
         ->pluck('users.id');

 $pendingMentoringCount = DB::table('mentoring_infos')
    ->where('mentoring_infos.status', '0')
    ->whereIn('mentoring_infos.user_id', $mentee_id)
    ->count();



$pendingUpdateRequestCount = DB::table('student_update_request')
    ->where('status', 0)
    ->whereIn('userid', function($query) {
        $query->select('student_details.user_id')
              ->from('assigned_mentor')
              ->join('student_details', 'assigned_mentor.mentee_id', '=', 'student_details.id')
              ->where('assigned_mentor.mentor_id', Session::get('userid'));
    })
    ->count();

        return view('admin.assign-subjects', [
            'pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount,
            'departments' => $departments,
            'subjects' => $subjects
        ]);
    }

    public function getStudentsByDepartment(Request $request) {
        $request->validate([
            'department_id' => 'required|exists:department,id',
            'session' => 'required|string'
        ]);

        $students = DB::table('student_details')
            ->select('student_details.id', 'student_details.reg_no', 'student_details.roll_no', 'users.name')
            ->join('users', 'student_details.user_id', '=', 'users.id')
            ->where('users.department', $request->department_id)
            ->where('student_details.session', $request->session)
            ->orderBy('users.name')
            ->get();

        return response()->json($students);
    }

    public function getSubjectsByDepartment(Request $request) {
        $request->validate([
            'department_id' => 'required|exists:department,id',
            'semester' => 'required|integer|min:1|max:8',
            'session' => 'required|string'
        ]);

        $subjects = Subject::where('department_id', $request->department_id)
            ->where('semester', $request->semester)
            ->where('session', $request->session)
            ->orderBy('name')
            ->get();

        return response()->json($subjects);
    }

    public function assignSubjectsStore(Request $request) {
        $validate = $request->validate([
            'department_id' => 'required|exists:department,id',
            'semester' => 'required|integer|min:1|max:8',
            'session' => 'required|string',
            'academic_year' => 'required|string',
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:student_details,id',
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id'
        ]);

        $assignedCount = 0;

        foreach($validate['student_ids'] as $studentId) {
            foreach($validate['subject_ids'] as $subjectId) {
                // Check if assignment already exists
                $exists = StudentSubject::where('student_id', $studentId)
                    ->where('subject_id', $subjectId)
                    ->where('semester', $validate['semester'])
                    ->where('academic_year', $validate['academic_year'])
                    ->exists();

                if(!$exists) {
                    StudentSubject::create([
                        'student_id' => $studentId,
                        'subject_id' => $subjectId,
                        'semester' => $validate['semester'],
                        'academic_year' => $validate['academic_year']
                    ]);

                    $assignedCount++;
                }
            }
        }

        return redirect()->route('assign.subjects')
            ->with('success', $assignedCount . ' subject assignments created successfully!');
    }
}
