<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AcademicDetailsController extends Controller
{
    // Sessions Methods
    public function sessions()
    {
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


        return view('admin.session', compact('sessions','pendingUpdateRequestCount','pendingMentoringCount'));
    }

    public function addSession()
    {

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

        return view('admin.add-session',['pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount]);
    }

    public function storeSession(Request $request)
    {
        $request->validate([
            'session' => 'required|regex:/^\d{4}-\d{2}$/|unique:academic_sessions,session',
            'description' => 'nullable|string|max:1000',
        ]);

        // Insert into academic_sessions using query builder
        DB::table('academic_sessions')->insert([
            'session' => $request->session,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.sessions')->with('success', 'Session added successfully');
    }

    public function deleteSession($id){
        $id = decrypt($id);
        DB::table('academic_sessions')->where('id',$id)->delete();
        return redirect()->back()->with('success','Session deleted successfully.');
    }



    // Departments Methods
    public function departments()
    {
       $departments = DB::table('department')
       ->join('academic_sessions','department.session_id','=','academic_sessions.id')
       ->select('department.*','academic_sessions.session')
       ->orderBy('department.department_name','asc')->get();

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

        // dd($departments);

        return view('admin.department', ['departments' => $departments, 'pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount,]);
    }

    public function addDepartment()
    {
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

        return view('admin.add-department', compact('sessions','pendingUpdateRequestCount','pendingMentoringCount'));
    }

    public function storeDepartment(Request $request)
    {
        $request->validate([
            'session' => 'required|exists:academic_sessions,id',
            'department_name' => 'required|string|max:255',
        ]);

        $exists = DB::table('department')
        ->where('session_id', $request->session)
        ->where('department_name', $request->department_name)
        ->exists();

    if ($exists) {
        return back()->withErrors(['department_name' => 'This department already exists for the selected session.'])->withInput();
    }

    DB::table('department')->insert([
        'session_id' => $request->session,
        'department_name' => $request->department_name,

        // 'created_at' => now(),

    ]);

        return redirect()->route('admin.departments')->with('success', 'Department added successfully');
    }


    public function deleteDepartment($id){
        $id = decrypt($id);
        DB::table('department')->where('id',$id)->delete();
        return redirect()->back()->with('success','Department deleted successfully');
    }


    // public function getDepartmentsBySession($sessionId)
    // {
    //     $departments = session('departments', []);
    //     $filteredDepartments = collect($departments)->where('academic_session_id', $sessionId)->values()->all();

    //     return response()->json($filteredDepartments);
    // }

    // Semesters Methods
    public function semesters()
    {
        $semesters = DB::table('academic_semisters')
        ->join('academic_sessions', 'academic_semisters.session_id', '=', 'academic_sessions.id')
        ->join('department', 'academic_semisters.department_id', '=', 'department.id')
        ->select(
            'academic_semisters.*',
            'academic_sessions.session as session_name',
            'department.department_name as department_name'
        )
        ->orderBy('academic_semisters.id', 'desc')
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

        return view('admin.semester', ['semesters' => $semesters, 'pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount]);
    }

    public function addSemester()
    {
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

        return view('admin.add-semester', compact('sessions','pendingUpdateRequestCount','pendingMentoringCount'));
    }


        public function getDepartmentsBySession(Request $request)
    {
        $departments = DB::table('department')
            ->where('session_id', $request->session_id)
            ->select('id', 'department_name')
            ->get();
        // dd($departments);
        return response()->json(['departments' => $departments]);
    }


    public function storeSemester(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'session' => 'required|exists:academic_sessions,id',
            'department' => 'required|exists:department,id',
            'semester_name' => 'required|string|max:255',
            'semester_type' => 'required|in:even,odd',
            'months' => 'required|array|min:1',
            'months.*' => 'string'
        ]);

        DB::table('academic_semisters')->insert([
            'session_id' => $request->session,
            'department_id' => $request->department,
            'semister_name' => $request->semester_name,
            'semister_type' => $request->semester_type,
            'months' => json_encode($request->months),
            'created_at' => now(),

        ]);

        return redirect()->route('admin.semesters')->with('success', 'Semester added successfully');
    }


    public function deleteSemester($id){
        $id = decrypt($id);
        DB::table('academic_semisters')->where('id',$id)->delete();
        return redirect()->back()->with('success','Semester deleted successfully.');
    }
}
