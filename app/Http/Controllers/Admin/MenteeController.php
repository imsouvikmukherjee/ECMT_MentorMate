<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;


class MenteeController extends Controller
{

    public function mentees(){
        $mentees = DB::table('users')
        ->select('users.id','users.name','users.email','users.contact', 'users.user_image', 'department.department_name')
        ->join('department', 'users.department', '=', 'department.id')
        ->where('users.usertype', 'Student')
        ->orderBy('users.id', 'desc')
        ->get();
        // dd($mentees);

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

        return view('admin.mentees', ['pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount, 'mentees' => $mentees]);
    }


    public function addMentee(){
        // $departments = DB::table('department')->orderBy('department_name','asc')->get();
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

        return view('admin.add-mentees', ['pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount, 'sessions' => $sessions]);
    }

    public function getDepartmentsBySession(Request $request)
    {
        // dd($request->all());
        $departments = DB::table('department')
            ->where('session_id', $request->session_id)
            ->select('id', 'department_name')
            ->get();
        // dd($departments);
        return response()->json(['departments' => $departments]);
    }

    public function addMenteeStore(Request $request)
{
    $request->validate([
        'session' => 'required',
        'department' => 'required',
        'mentees_data' => 'required|file|mimes:xlsx',
    ]);

    $file = $request->file('mentees_data');
    $department = $request->input('department');
    $session = DB::table('academic_sessions')->where('id', $request->session)->first();

    $spreadsheet = IOFactory::load($file->getRealPath());
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();

    // dd($session->session);
        // Remember to use IOFactory
        // composer require phpoffice/phpspreadsheet
        //enable - extension=zip in php.ini file


    foreach ($rows as $index => $row) {
        if ($index === 0) continue; // Skip header

        if (array_filter($row) === []) continue; // Skip fully empty rows

        [
            $_, $_, $aadhaarNo, $studentName, $fatherName, $motherName, $dob, $nationality,
            $category, $sex, $bloodGroup, $religion, $guardianName, $guardianAddress,
            $guardianMobile, $relationWithGuardian, $residenceStatus, $studentAddress,
            $state, $district, $pin, $studentMobile, $email, $alternateMobile
        ] = $row;

        // Trim fields
        $studentName = trim($studentName);
        $email = trim($email);

        // Skip row if critical fields are empty
        if (empty($studentName) || empty($email)) continue;

        // Validation
        $validator = Validator::make([
            'aadhaar_no' => $aadhaarNo,
            'student_name' => $studentName,
            'father_name' => $fatherName,
            'mother_name' => $motherName,
            'dob' => $dob,
            'nationality' => $nationality,
            'category' => $category,
            'sex' => $sex,
            'blood_group' => $bloodGroup,
            'religion' => $religion,
            'guardian_name' => $guardianName,
            'guardian_address' => $guardianAddress,
            'guardian_mobile' => $guardianMobile,
            'relation_with_guardian' => $relationWithGuardian,
            'residence_status' => $residenceStatus,
            'student_address' => $studentAddress,
            'state' => $state,
            'district' => $district,
            'pin' => $pin,
            'student_mobile' => $studentMobile,
            'email' => $email,
            'alternate_mobile' => $alternateMobile,
        ], [
            'aadhaar_no' => 'nullable|string|digits:12',
            'student_name' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'nationality' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'sex' => 'nullable|string|max:255',
            'blood_group' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_address' => 'nullable|string',
            'guardian_mobile' => 'nullable|string|digits:10',
            'relation_with_guardian' => 'nullable|string|max:255',
            'residence_status' => 'nullable|string|max:255',
            'student_address' => 'nullable|string',
            'state' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'pin' => 'nullable|digits:6',
            'student_mobile' => 'nullable|string|digits:10',
            'email' => 'nullable|email|unique:users',
            'alternate_mobile' => 'nullable|string|digits:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Insert user
        $userId = DB::table('users')->insertGetId([
            'department' => $department,
            'name' => $studentName,
            'email' => $email,
            'contact' => $studentMobile,
            'password' => Hash::make('Student@#123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert student details
        DB::table('student_details')->insert([
            'user_id' => $userId,
            'session' => $session->session,
            'aadhaar_no' => $aadhaarNo,
            'father_name' => $fatherName,
            'mother_name' => $motherName,
            'dob' => $dob ? date('Y-m-d', strtotime($dob)) : null,
            'nationality' => $nationality,
            'category' => $category,
            'sex' => $sex,
            'blood_group' => $bloodGroup,
            'religion' => $religion,
            'guardian_name' => $guardianName,
            'guardian_address' => $guardianAddress,
            'guardian_mobile' => $guardianMobile,
            'relation_with_guardian' => $relationWithGuardian,
            'residence_status' => $residenceStatus,
            'student_address' => $studentAddress,
            'state' => $state,
            'district' => $district,
            'pin' => $pin,
            'alternate_mobile' => $alternateMobile,
            'created_at' => now(),
            // 'updated_at' => now(),
        ]);
    }

    return redirect()->route('mentee')->with('success', 'Mentee data uploaded successfully.');
}


    public function menteeDelete($id){
        $id = decrypt($id);
        DB::table('users')->where('id',$id)->delete();
        return redirect()->route('mentee')->with('success','Mentee Deleted Successfully,');
    }


    public function editMentee($id){

        $id = decrypt($id);
        // dd($id);
        $mentees = DB::table('student_details')->where('user_id',$id)->first();
        $data = DB::table('users')->where('id',$id)->first();

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

        return view('admin.edit-mentee', ['pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount, 'mentees' => $mentees, 'data' => $data]);
    }


    public function editMenteeStore(Request $request, $id){
        $id = decrypt($id);
        // dd($id);

        $validate = $request->validate([
            'session' => 'nullable|string|max:255',
            'aadhaar_no' => 'nullable|string|digits:12',

            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'nationality' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'sex' => 'nullable|string|max:255',
            'blood_group' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_address' => 'nullable|string',
            'guardian_mobile' => 'nullable|string|digits:10',
            'relation_with_guardian' => 'nullable|string|max:255',
            'residence_status' => 'nullable|string|max:255',
            'student_address' => 'nullable|string',
            'state' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'pin' => 'nullable|digits:6',

            'alternate_mobile' => 'nullable|string|digits:10',
            'reg_no' => 'nullable|max:16',
            'roll_no' => 'nullable|max:16'

        ]);

        $currentDate = Carbon::now()->format('Y-m-d');

        DB::table('student_details')->where('id',$id)->update([
           'session' => $validate['session'],
           'aadhaar_no' => $validate['aadhaar_no'],
           'father_name' => $validate['father_name'] ?? null,
           'mother_name' => $validate['mother_name'],
           'dob' => $validate['dob'],
           'nationality' => $validate['nationality'],
           'category' => $validate['category'],
           'sex' => $validate['sex'],
           'blood_group' => $validate['blood_group'],
           'religion' => $validate['religion'],
           'guardian_name' => $validate['guardian_name'],
           'guardian_address' => $validate['guardian_address'],
           'guardian_mobile' => $validate['guardian_mobile'],
           'relation_with_guardian' => $validate['relation_with_guardian'],
           'residence_status' => $validate['residence_status'],
           'student_address' => $validate['student_address'],
           'state' => $validate['state'],
           'district' => $validate['district'],
           'pin' => $validate['pin'],
           'alternate_mobile' => $validate['alternate_mobile'] ?? null,
           'reg_no' => $validate['reg_no'] ?? null,
           'roll_no' => $validate['roll_no'] ?? null,
           'updated_at' => $currentDate
        ]);

        return redirect()->route('mentee')->with('success','Mentee Modified Successfully.');
    }


    public function menteeInfo($id){
        $id = decrypt($id);

        $mentee = DB::table('users')->select('users.*','department.department_name')
        ->join('department','users.department','=','department.id')
        ->where('users.id',$id)->first();

        $mentee_details = DB::table('student_details')->select('student_details.*', DB::raw("DATE_FORMAT(student_details.created_at, '%Y-%m-%d') AS created_at"),  DB::raw("DATE_FORMAT(student_details.updated_at, '%Y-%m-%d') AS updated_at"))->where('user_id',$id)->first();


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

        return view('admin.mentees-info', ['pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount, 'mentee' => $mentee, 'mentee_details' => $mentee_details]);
    }


    public function bulkDelete(Request $request){

         $request->validate([
            'selected_ids' => 'required|array|min:1',
            'selected_ids.*' => 'integer',
        ]);


       $deleteCount = DB::table('users')->whereIn('id', $request->selected_ids)->delete();

        return redirect()->back()->with('success', '</strong>'.$deleteCount.'</strong>'.' - mentees have been deleted successfully.');
    }
}

