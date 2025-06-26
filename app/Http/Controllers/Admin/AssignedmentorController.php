<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AssignedmentorController extends Controller
{

    public function viewAssignMentees(){

        $mentorEmail = session('email'); // or session()->get('email')

    // Get mentor's ID using the email (you can also store and use ID directly from session if available)
    $mentor = DB::table('users')->where('email', $mentorEmail)->first();

        $assignedData = DB::table('assigned_mentor')
        ->select(
            'assigned_mentor.id',
            'mentor_users.name as mentor_name',
            'mentee_users.name as mentee_name',
            'mentee_users.email as mentee_email',
            'mentee_users.user_image as user_image',
            'student_details.session',
            'department.department_name as department_name'
        )
        ->join('users as mentor_users', 'assigned_mentor.mentor_id', '=', 'mentor_users.id')
        ->join('student_details', 'assigned_mentor.mentee_id', '=', 'student_details.id')
        ->join('users as mentee_users', 'student_details.user_id', '=', 'mentee_users.id')
        ->join('department', 'mentee_users.department', '=', 'department.id')
        ->where('assigned_mentor.mentor_id', $mentor->id)
        ->orderBy('assigned_mentor.id', 'desc')
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

        return view('admin.view-assign-mentees', ['assignedData' => $assignedData, 'pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount]);
    }


    public function changeRequest(){

        $student = DB::table('assigned_mentor')
        ->select('users.id')
        ->join('student_details','assigned_mentor.mentee_id','=','student_details.id')
        ->join('users','student_details.user_id','=','users.id')
        ->where('assigned_mentor.mentor_id',Session::get('userid'))->get();
        // dd($student);

        $ids = $student->pluck('id')->toArray();
        // dd($ids);
        $changeRequests = DB::table('student_update_request')
        ->whereIn('userid', $ids)
        ->select('student_update_request.*',DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') AS created_at"))
        ->orderBy('id','desc')
        ->get();
        // dd($changeRequests);

        $studentData = DB::table('student_details')
        ->join('users','student_details.user_id','=','users.id')
        ->join('department','users.department','=','department.id')
        ->select('student_details.*', 'users.name','users.email','users.contact','department.department_name')
        ->whereIn('student_details.user_id', $ids)
        ->orderBy('student_details.id','desc')
        ->get();

        // dd($studentData);
        $mergedData = [];

    foreach ($changeRequests as $request) {
        $student = $studentData->firstWhere('user_id', $request->userid);
        if ($student) {
            $mergedData[] = [
                'student' => $student,
                'request' => $request,
            ];
        }
    }

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

    // dd($mergedData);
        return view('admin.change-request', ['changeRequests' => $changeRequests, 'pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount, 'mergedData' => $mergedData]);
    }


    public function changeRequestDelete($id){
        $id = decrypt($id);
        DB::table('student_update_request')->where('id',$id)->delete();
        return redirect()->back()->with('success','Request deleted successfully.');
    }

    public function changeRequestApproval($id){

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


        return view('admin.change-request-approval',['pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount, 'id' => $id]);
    }


    public function changeRequestApprovalStore(Request $request, $id){

        $id = decrypt($id);

        $request->validate([
            'status' => 'required|in:0,1,2',
            'remark' => 'nullable|string|max:255',
        ]);

        $updateRequest = DB::table('student_update_request')->where('id', $id)->first();

        if (!$updateRequest) {
            return redirect()->back()->with('error', 'Update request not found.');
        }

            DB::table('student_update_request')
            ->where('id', $id)
            ->update([
                'status' => $request->status,
                'remark' => $request->remark,
                'updated_at' => now()
            ]);

            if ($request->status == '1') {
                DB::table('student_details')
                    ->where('user_id', $updateRequest->userid)
                    ->update([
                        'session' => $updateRequest->session,
                        'aadhaar_no' => $updateRequest->aadhaar_no,
                        'father_name' => $updateRequest->father_name,
                        'mother_name' => $updateRequest->mother_name,
                        'dob' => $updateRequest->dob,
                        'nationality' => $updateRequest->nationality,
                        'category' => $updateRequest->category,
                        'sex' => $updateRequest->sex,
                        'blood_group' => $updateRequest->blood_group,
                        'religion' => $updateRequest->religion,
                        'guardian_name' => $updateRequest->guardian_name,
                        'guardian_address' => $updateRequest->guardian_address,
                        'guardian_mobile' => $updateRequest->guardian_mobile,
                        'relation_with_guardian' => $updateRequest->relation_with_guardian,
                        'residence_status' => $updateRequest->residence_status,
                        'student_address' => $updateRequest->student_address,
                        'state' => $updateRequest->state,
                        'district' => $updateRequest->district,
                        'pin' => $updateRequest->pin,
                        'alternate_mobile' => $updateRequest->alternate_mobile,
                        'reg_no' => $updateRequest->reg_no,
                        'roll_no' => $updateRequest->roll_no,
                        'updated_at' => now(),
                    ]);

                // Optional: update `users` table (e.g., name)
                DB::table('users')->where('id', $updateRequest->userid)->update([
                    'name' => $updateRequest->name,
                    'contact' => $updateRequest->contact,
                    'updated_at' => now(),
                ]);
            }

            return redirect()->route('change_request')->with('success', 'Change request updated successfully.');
    }


    public function viewAssignedMentor(){

        $assignedData = DB::table('assigned_mentor')
        ->select(
            'assigned_mentor.id',
            'mentor_users.name as mentor_name',
            'mentee_users.name as mentee_name',
            'mentee_users.email as mentee_email',
            'student_details.session',
            'department.department_name as department_name'
        )
        ->join('users as mentor_users', 'assigned_mentor.mentor_id', '=', 'mentor_users.id')
        ->join('student_details', 'assigned_mentor.mentee_id', '=', 'student_details.id')
        ->join('users as mentee_users', 'student_details.user_id', '=', 'mentee_users.id')
        ->join('department', 'mentee_users.department', '=', 'department.id')
        ->orderBy('assigned_mentor.id', 'desc')
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
        // dd($assignedData);
        return view('admin.view-assigned-mentors', ['pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount, 'assignedData' => $assignedData]);
    }

    public function assignMentor(){

        $mentors = DB::table('users')->where('usertype','Mentor')->orderBy('name','asc')->get();
        // dd($mentors);
        $mentees = DB::table('student_details')->select('student_details.id','student_details.session','users.id AS userid','users.name','users.email','users.contact','department.department_name')
        ->join('users','student_details.user_id','=','users.id')
        ->join('department','users.department','=','department.id')
        ->orderBy('department.department_name','asc')->get();
        // dd($mentees);

        $departments = DB::table('department')
        ->selectRaw('MIN(id) as id, department_name')
        ->groupBy('department_name')
        ->orderBy('department_name', 'asc')
        ->get();




        // $sessions = DB::table('student_details')
        // ->select('session')
        // ->distinct()
        // ->get();

        $sessions = DB::table('academic_sessions')->orderBy('id','desc')->get();

        $assignedMentees = DB::table('assigned_mentor')
        ->pluck('mentee_id')
        ->toArray();


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

        return view('admin.assign-mentor',['mentors' => $mentors, 'pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount, 'mentees' => $mentees, 'departments' => $departments, 'sessions' => $sessions, 'assignedMentees' => $assignedMentees]);
    }



    public function getDepartmentsBySession(Request $request)
{
    $session = $request->session;
    // dd($session);
    $departments = DB::table('department')
        // ->join('department', 'mentoring_infos.department_id', '=', 'department.id')
        ->join('academic_sessions', 'department.session_id', '=', 'academic_sessions.id')
        ->where('academic_sessions.session', $session)
        ->select('department.id', 'department.department_name')
        ->distinct()
        ->get();

    return response()->json(['departments' => $departments]);
}




    public function filterMentees(Request $request)
{
    // dd($request->all());
    $mentees = DB::table('student_details')
        ->select('student_details.id', 'student_details.session', 'users.id AS userid', 'users.name', 'users.email', 'department.department_name')
        ->join('users', 'student_details.user_id', '=', 'users.id')
        ->join('department', 'users.department', '=', 'department.id');
        // $mentor = null;

    if ($request->department) {
        $mentees->where('users.department', $request->department);
    }

    if ($request->session) {
        $mentees->where('student_details.session', $request->session);
    }

    // if ($request->mentorId) {
    //     $mentees->where('users.id', $request->mentorId);
    // }

    $mentees = $mentees->orderBy('users.name', 'asc')->get();
    // dd($mentees);

    $assignedMentees = DB::table('assigned_mentor')
    ->pluck('mentee_id')
    ->toArray();

    return response()->json([
        'mentees' => $mentees,
        'assignedMentees' => $assignedMentees,
    ]);
}


    public function assignMentorStore(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'mentor' => 'required|exists:users,id',
            'mentee_ids' => 'required|json',
        ]);

        $mentorId = $request->mentor;
        $menteeIds = json_decode($request->mentee_ids, true);

        foreach ($menteeIds as $menteeId) {
            DB::table('assigned_mentor')->insert([
                'mentor_id' => $mentorId,
                'mentee_id' => $menteeId,
                'created_at' => now(),
            ]);
        }

        return redirect()->route('view_assign_mentors')->with('success', 'Mentees assigned successfully!');
    }


    public function assignMentorDelete($id){
        $id = decrypt($id);
        DB::table('assigned_mentor')->where('id',$id)->delete();
        return redirect()->route('view_assign_mentors')->with('success','The assigned mentor has been successfully removed.');
    }


    public function bulkDelete(Request $request){
        $request->validate([
            'selected_ids' => 'required|array|min:1',
            'selected_ids.*' => 'integer',
        ]);


      $deletedCount  =  DB::table('assigned_mentor')->whereIn('id', $request->selected_ids)->delete();

        return redirect()->back()->with('success', '<strong>'.$deletedCount.'</strong>'.' - assigned mentees have been successfully removed from the system.');
    }

}
