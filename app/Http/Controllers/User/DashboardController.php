<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Models\ProfileChangeRequest;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function userDashboard(){

        $email = Session::get('email');

        $student = DB::table('users')
        ->join('department','users.department','=','department.id')
        ->select('users.*','department.department_name')
        ->where('email',$email)->where('usertype','Student')->first();
        // dd($student);

        if($student){
            $student_details = DB::table('student_details')->where('user_id',$student->id)->first();
        }
        // dd($student);


        $menteeEmail = session('email');


        // $mentee = DB::table('users')->where('email', $menteeEmail)
        // ->join('student_details')
        // ->first();

        $mentee = DB::table('student_details')
        ->select('student_details.id AS student_id','users.id AS user_id','users.email')
        ->join('users','student_details.user_id','=','users.id')
        ->where('users.email',$menteeEmail)->first();

            $assignedData = DB::table('assigned_mentor')
            ->select(
                'assigned_mentor.id',
                'mentor_users.name as mentor_name',
                'mentor_users.email as mentor_email',
                'mentor_users.contact as mentor_contact',
                'mentee_users.name as mentee_name',
                'mentee_users.email as mentee_email',
                // 'assigned_mentor.mentee_id as mentee_id',

                'student_details.session',
                'department.department_name as department_name'
            )

            ->join('users as mentor_users', 'assigned_mentor.mentor_id', '=', 'mentor_users.id')
            ->join('student_details', 'assigned_mentor.mentee_id', '=', 'student_details.id')
            ->join('users as mentee_users', 'student_details.user_id', '=', 'mentee_users.id')
            ->join('department', 'mentee_users.department', '=', 'department.id')
            ->where('assigned_mentor.mentee_id', $mentee->student_id)
            // ->orderBy('assigned_mentor.id', 'desc')
            ->first();
            // dd($assignedData);

        return view('student.dashboard', ['student' => $student, 'assignedData' => $assignedData, 'student_details' => $student_details]);
    }

    public function editProfile(){
        $user_id = Auth::id();

        // Debug: Log the authenticated user ID
        Log::info('Edit Profile - Authenticated User ID: ' . $user_id);

        $student = DB::table('student_details')
            ->select(
                'student_details.*',
                'users.name',
                'users.email',
                'users.user_image',
                'users.contact',
                'department.department_name',
                'users.department as department_id'
            )
            ->join('users', 'student_details.user_id', '=', 'users.id')
            ->leftJoin('department', 'users.department', '=', 'department.id')
            ->where('student_details.user_id', $user_id)
            ->first();


            $changeRequests = DB::table('student_update_request')->select('status','remark',DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') AS created_at"))
            ->where('userid',Session::get('userid'))
            ->orderBy('id','desc')->get();




        return view('student.edit-profile', compact('student',  'changeRequests'));
    }

    public function updateProfile(Request $request){
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'nationality' => 'required|string',
            'category' => 'required|string',
            'gender' => 'required|string',
            'father_name' => 'required|string',
            'mother_name' => 'required|string',
            'blood_group' => 'required|string',
            'religion' => 'required|string',
            'aadhaar_no' => 'required|string|digits:12',
            'student_address' => 'required|string',
            'alternate_mobile' => 'required|string',
            'state' => 'required|string',
            'district' => 'required|string',
            'pin' => 'required|string',
            'primary_mobile' => 'required|string',
            'guardian_name' => 'required|string',
            'guardian_mobile' => 'required|string',
            'guardian_address' => 'required|string',
            'relation_with_guardian' => 'required|string',
            'residence_status' => 'required|string',
            'session' => ['required', 'regex:/^\d{4}-\d{2}$/'],
            // roll_no and reg_no are optional
            'reg_no' => 'nullable|string',
            'roll_no' => 'nullable|string',
        ]);


        $exists = DB::table('student_update_request')
        ->where('userid', Session::get('userid'))
        ->where('status', 0)
        ->exists();

    if ($exists) {
        return back()->withErrors([
            'request' => 'You already have a pending profile change request. Please wait for it to be processed before submitting another request.'
        ])->withInput();
    }


        DB::table('student_update_request')->insert([
            'userid' => session('userid'),
            'user_email' => Session::get('email'),
            'name' => $request->name,
            'dob' => $request->dob,
            'nationality' => $request->nationality,
            'category' => $request->category,
            'sex' => $request->gender,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'blood_group' => $request->blood_group,
            'religion' => $request->religion,
            'aadhaar_no' => $request->aadhaar_no,
            'student_address' => $request->student_address,
            'alternate_mobile' => $request->alternate_mobile,
            'state' => $request->state,
            'district' => $request->district,
            'pin' => $request->pin,
            'contact' => $request->primary_mobile,
            'guardian_name' => $request->guardian_name,
            'guardian_mobile' => $request->guardian_mobile,
            'guardian_address' => $request->guardian_address,
            'relation_with_guardian' => $request->relation_with_guardian,
            'residence_status' => $request->residence_status,
            'session' => $request->session,
            'reg_no' => $request->reg_no ?? null,
            'roll_no' => $request->roll_no ?? null,
            'created_at' => now(),
            // 'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Your profile update request has been successfully submitted and is currently awaiting administrative approval.');
    }

    /**
     * Get all updateable fields from the request
     */
    private function getAllUpdateableFields(Request $request)
    {
        return [
            'dob' => $request->dob,
            'nationality' => $request->nationality,
            'category' => $request->category,
            'sex' => $request->sex,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'blood_group' => $request->blood_group,
            'religion' => $request->religion,
            'aadhaar_no' => $request->aadhaar_no,
            'student_address' => $request->student_address,
            'alternate_mobile' => $request->alternate_mobile,
            'state' => $request->state,
            'district' => $request->district,
            'pin' => $request->pin,
            'gurdian_name' => $request->gurdian_name,
            'guardian_mobile' => $request->guardian_mobile,
            'gurdian_address' => $request->gurdian_address,
            'relation_with_guardian' => $request->relation_with_guardian,
            'residence_status' => $request->residence_status,
            'session' => $request->session,
            'reg_no' => $request->reg_no,
            'roll_no' => $request->roll_no,
        ];
    }

    /**
     * Detect changes between current student data and request data
     */
    private function detectChanges($student, Request $request)
    {
        $changes = [];

        // Define field mappings with friendly names
        $fields = [
            'name' => 'Full Name',
            'dob' => 'Date of Birth',
            'nationality' => 'Nationality',
            'category' => 'Category',
            'sex' => 'Gender',
            'father_name' => 'Father\'s Name',
            'mother_name' => 'Mother\'s Name',
            'blood_group' => 'Blood Group',
            'religion' => 'Religion',
            'aadhaar_no' => 'Aadhaar Number',
            'student_address' => 'Address',
            'alternate_mobile' => 'Alternate Mobile Number',
            'state' => 'State',
            'district' => 'District',
            'pin' => 'PIN Code',
            'gurdian_name' => 'Guardian Name',
            'guardian_mobile' => 'Guardian Mobile',
            'gurdian_address' => 'Guardian Address',
            'relation_with_guardian' => 'Relation with Guardian',
            'residence_status' => 'Residence Status',
            'session' => 'Session',
            'reg_no' => 'Registration Number',
            'roll_no' => 'Roll Number',
        ];

        // Check each field for changes
        foreach ($fields as $field => $fieldName) {
            // For name field, we need to get it from the users table through student data
            $currentValue = $field === 'name' ?
                DB::table('users')->where('id', $student->user_id)->value('name') :
                $student->$field;

            // Handle date fields specially
            if ($field === 'dob' && $currentValue) {
                $currentValue = date('Y-m-d', strtotime($currentValue));
            }

            if ($request->has($field) && $currentValue != $request->$field) {
                $changes[$field] = [
                    'from' => $currentValue,
                    'to' => $request->$field,
                    'field_name' => $fieldName
                ];
            }
        }

        return $changes;
    }

    public function showChangeRequests() {
        $user_id = Auth::id();

        $requests = collect([]);

        try {
            // Check if profile_change_requests table exists
            if(Schema::hasTable('profile_change_requests')) {
                $requests = ProfileChangeRequest::where('user_id', $user_id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
            } else {
                Log::warning('profile_change_requests table does not exist');
            }
        } catch (\Exception $e) {
            Log::error('Error querying profile_change_requests: ' . $e->getMessage());
        }

        return view('student.change-requests', compact('requests'));
    }

    /**
     * Display the mentoring information page with semester tabs
     */
    public function mentoring() {

        $mentoring = DB::table('mentoring_infos')
        ->join('academic_sessions','mentoring_infos.session_id','=','academic_sessions.id')
        ->join('department','mentoring_infos.department_id','=','department.id')
        ->join('academic_semisters','mentoring_infos.semester_id','=','academic_semisters.id')
        ->join('users','mentoring_infos.user_id','=','users.id')
        ->select('mentoring_infos.*',DB::raw('DATE(mentoring_infos.created_at) as created_date'),'academic_sessions.session','department.department_name','academic_semisters.semister_name','users.name')
        ->where('mentoring_infos.user_id',Session::get('userid'))
        ->orderBy('mentoring_infos.id','desc')
        ->get();
        // dd($mentoring);

          $student = DB::table('users')->where('id',Session::get('userid'))->first();


           $menteeEmail = session('email');


        // $mentee = DB::table('users')->where('email', $menteeEmail)
        // ->join('student_details')
        // ->first();

        $mentee = DB::table('student_details')
        ->select('student_details.id AS student_id','users.id AS user_id','users.email')
        ->join('users','student_details.user_id','=','users.id')
        ->where('users.email',$menteeEmail)->first();

            $assignedData = DB::table('assigned_mentor')
            ->select(
                'assigned_mentor.id',
                'mentor_users.name as mentor_name',
                'mentor_users.email as mentor_email',
                'mentor_users.contact as mentor_contact',
                'mentee_users.name as mentee_name',
                'mentee_users.email as mentee_email',
                // 'assigned_mentor.mentee_id as mentee_id',

                'student_details.session',
                'department.department_name as department_name'
            )

            ->join('users as mentor_users', 'assigned_mentor.mentor_id', '=', 'mentor_users.id')
            ->join('student_details', 'assigned_mentor.mentee_id', '=', 'student_details.id')
            ->join('users as mentee_users', 'student_details.user_id', '=', 'mentee_users.id')
            ->join('department', 'mentee_users.department', '=', 'department.id')
            ->where('assigned_mentor.mentee_id', $mentee->student_id)
            // ->orderBy('assigned_mentor.id', 'desc')
            ->first();
            // dd($assignedData);

        return view('student.mentoring',['mentoring' => $mentoring, 'assignedData' => $assignedData, 'student' => $student]);
    }


    public function mentoringInfo($id){
        $id = decrypt($id);

        $theory = DB::table('theory_exams')->where('mentoring_info_id',$id)
        ->orderBy('paper_code','asc')->get();

         $practical = DB::table('practical_exams')->where('mentoring_info_id',$id)
        ->orderBy('paper_code','asc')->get();

         $semesters = DB::table('semester_marks')->where('mentoring_info_id',$id)
        ->orderBy('paper_code','asc')->get();

         $mentoring = DB::table('mentoring_infos')->where('id',$id)
        ->first();

         $attendance = DB::table('attendance_records')->where('mentoring_info_id',$id)
        ->orderBy('subject','asc')->get();

        // Separate subject-wise and overall attendance
        $subjectAttendance = $attendance->filter(function ($item) {
            return $item->subject !== 'Overall Attendance';
        });

        $overallAttendance = $attendance->firstWhere('subject', 'Overall Attendance');

         $language = DB::table('communication_patterns')->where('mentoring_info_id',$id)
        ->orderBy('language','asc')->get();

        $body_language = DB::table('communication_pattern2')->where('mentoring_info_id',$id)
        ->orderBy('body_language','asc')->get();

          $student = DB::table('users')->where('id',Session::get('userid'))->first();

        return view('student.mentoring-info', ['theory' => $theory, 'student' => $student, 'body_language' => $body_language, 'language' => $language, 'subjectAttendance' => $subjectAttendance, 'overallAttendance' => $overallAttendance, 'mentoring' => $mentoring, 'practical' => $practical, 'semesters' => $semesters]);
    }

    /**
     * Update the mentoring data for a specific semester
     */

     public function mentoringUpdate($id){
        $id = decrypt($id);

        $theory = DB::table('theory_exams')->where('mentoring_info_id',$id)->get();

        $practical = DB::table('practical_exams')->where('mentoring_info_id',$id)->get();

        $semester_marks = DB::table('semester_marks')->where('mentoring_info_id',$id)->get();

        $attendance_records = DB::table('attendance_records')->where('mentoring_info_id',$id)->get();

        $communication_patterns = DB::table('communication_patterns')->where('mentoring_info_id',$id)->get();

        $communication_pattern2 = DB::table('communication_pattern2')->where('mentoring_info_id',$id)->get();

                $bodyLanguageTypes = [];
                $bodyLanguageValues = [];

                foreach ($communication_pattern2 as $item) {
                    $bodyLanguageTypes[] = $item->type;
                    $bodyLanguageValues[] = $item->body_language;
                }

        $mentoring_info = DB::table('mentoring_infos')->where('id',$id)->first();

          $student = DB::table('users')->where('id',Session::get('userid'))->first();

        return view('student.edit-mentoring', ['theory' => $theory,
        'communication_pattern2' => $communication_pattern2,
        'communication_patterns' => $communication_patterns,
        'bodyLanguageTypes' => $bodyLanguageTypes,
        'bodyLanguageValues' => $bodyLanguageValues,
         'mentoring_info' => $mentoring_info,
         'attendance_records' => $attendance_records,
         'semester_marks' => $semester_marks,
         'student' => $student,
          'practical' => $practical]);
     }


     public function mentoringUpdateStore(Request $request, $id){

        // dd($request->all());

        $id = decrypt($id);
         $request->validate([

        // 'session'    => 'required|string|max:255',
        // 'department' => 'required|string|max:255',
        // 'semester'   => 'required|string|max:255',


        'subject'       => 'required|array|min:1',
        'subject.*'     => 'required|string|max:255',
        'paper_code'    => 'required|array|min:1',
        'paper_code.*'  => 'required|string|max:100',
        'ca1'           => 'nullable|array',
        'ca1.*'         => 'nullable|integer|min:0|max:25',
        'ca2'           => 'nullable|array',
        'ca2.*'         => 'nullable|integer|min:0|max:25',
        'ca3'           => 'nullable|array',
        'ca3.*'         => 'nullable|integer|min:0|max:25',
        'ca4'           => 'nullable|array',
        'ca4.*'         => 'nullable|integer|min:0|max:25',


        'practical_subject'      => 'nullable|array|min:1',
        'practical_subject.*'    => 'required|string|max:255',
        'practical_code'         => 'nullable|array|min:1',
        'practical_code.*'       => 'required|string|max:100',
        'pca1'                   => 'nullable|array',
        'pca1.*'                 => 'nullable|integer|min:0|max:40',
        'pca2'                   => 'nullable|array',
        'pca2.*'                 => 'nullable|integer|min:0|max:40',


        'semester_subject'        => 'required|array|min:1',
        'semester_subject.*'      => 'required|string|max:255',
        'semester_subject_code'   => 'required|array|min:1',
        'semester_subject_code.*' => 'required|string|max:100',
        'semester_grade'          => 'nullable|array',
        'semester_grade.*'        => 'nullable|in:O,E,A,B,C,D,F',
        'semester_points'         => 'nullable|array',
        'semester_points.*'       => 'nullable|integer|min:0|max:10',
        'semester_credit'         => 'nullable|array',
        'semester_credit.*'       => 'nullable|min:0|max:10|numeric|regex:/^\d+(\.\d)?$/',
        'semester_credit_points'  => 'nullable|array',
        'semester_credit_points.*'=> 'nullable|numeric|min:0|max:100',
        'sgpa'                    => 'nullable|numeric|min:0|max:10',


        'attendance_subject'   => 'required|array|min:1',
        'attendance_subject.*' => 'required|string|max:255',
        'Jan'  => 'nullable|array',
        'Jan.*'=> 'nullable|integer|min:0|max:100',
        'Feb.*'=> 'nullable|integer|min:0|max:100',
        'Mar.*'=> 'nullable|integer|min:0|max:100',
        'Apr.*'=> 'nullable|integer|min:0|max:100',
        'May.*'=> 'nullable|integer|min:0|max:100',
        'Jun.*'=> 'nullable|integer|min:0|max:100',
        'Jul.*'=> 'nullable|integer|min:0|max:100',
        'Aug.*'=> 'nullable|integer|min:0|max:100',
        'Sep.*'=> 'nullable|integer|min:0|max:100',
        'Oct.*'=> 'nullable|integer|min:0|max:100',
        'Nov.*'=> 'nullable|integer|min:0|max:100',
        'Dec.*'=> 'nullable|integer|min:0|max:100',


        'language'              => 'nullable|array|min:1',
        'language.*'            => 'nullable|string|max:100',
        'language_proficiency'  => 'nullable|array',
        'language_proficiency.*'=> 'nullable',


        'body_language_type'    => 'nullable|array|min:1',
        'body_language_type.*'  => 'nullable|string|max:100',
        'body_language_value'   => 'nullable|array',
        'body_language_value.*' => 'nullable|in:Yes,No',


        'certifications'              => 'nullable|string',
        'workshops'                   => 'nullable|string',
        'competitions'                => 'nullable|string',
        'projects'                    => 'nullable|string',
        'extra_curricular_activities' => 'nullable|string',
        'cultural_activities'         => 'nullable|string',
        'club_memberships'            => 'nullable|string',
        'social_service_activities'   => 'nullable|string',
        'community_engagement'        => 'nullable|string',
    ]);




    //  $existing = DB::table('mentoring_infos')
    //         ->where('session_id', $request->session)
    //         ->where('department_id', $request->department)
    //         ->where('semester_id', $request->semester)
    //         ->where('user_id', Session::get('userid'))
    //         ->exists();

    //     if ($existing) {
    //         return redirect()->back()
    //             ->withErrors(['combination' => 'You have already submitted the mentoring information for this semester. You may update or edit the existing entry if needed.'])
    //             ->withInput();
    //     }

         DB::table('theory_exams')
        ->where('mentoring_info_id', $id)
        ->delete();
        DB::table('practical_exams')->where('mentoring_info_id', $id)->delete();
        DB::table('semester_marks')->where('mentoring_info_id', $id)->delete();
        DB::table('attendance_records')->where('mentoring_info_id', $id)->delete();
        DB::table('communication_patterns')->where('mentoring_info_id', $id)->delete();
        DB::table('communication_pattern2')->where('mentoring_info_id', $id)->delete();

        DB::table('mentoring_infos')->where('id',$id)->update([
        // 'session_id' => $request->session,
        // 'department_id' => $request->department,
        // 'semester_id' => $request->semester,
        // 'user_id' => Session::get('userid'),
        'status' => '0',
        'sgpa' => $request->sgpa,
        'certifications' => $request->certifications,
        'workshops' => $request->workshops,
        'competitions' => $request->competitions,
        'projects' => $request->projects,
        'sports_participation' => $request->sports_participation,
        'cultural_activities' => $request->cultural_activities,
        'club_memberships' => $request->club_memberships,
        'social_service_activities' => $request->social_service_activities,
        'community_engagement' => $request->community_engagement,
        'updated_at' => now(),

    ]);

    $mentoringInfoId = $id;

    if ($request->has('subject')) {
        foreach ($request->subject as $key => $subject) {
            DB::table('theory_exams')->insert([
                'mentoring_info_id' => $mentoringInfoId,
                'subject_name' => $subject,
                'paper_code' => $request->paper_code[$key],
                'ca1' => $request->ca1[$key],
                'ca2' => $request->ca2[$key],
                'ca3' => $request->ca3[$key],
                'ca4' => $request->ca4[$key],
                'created_at' => now(),

            ]);
        }
    }

     if ($request->practical_subject && $request->practical_code) {
        foreach ($request->practical_subject as $key => $subject) {
            DB::table('practical_exams')->insert([
                'mentoring_info_id' => $mentoringInfoId,
                'subject_name'        => $subject,
                'paper_code'     => $request->practical_code[$key],
                'pca1'           => $request->pca1[$key] ?? null,
                'pca2'           => $request->pca2[$key] ?? null,
                'created_at'     => now(),

            ]);
        }
    }

    if ($request->semester_subject && $request->semester_subject_code) {
        foreach ($request->semester_subject as $key => $subject) {
            DB::table('semester_marks')->insert([
                'mentoring_info_id' => $mentoringInfoId,
                'subject'         => $subject,
                'paper_code'      => $request->semester_subject_code[$key],
                'letter_grade'    => $request->semester_grade[$key] ?? null,
                'points'          => $request->semester_points[$key] ?? null,
                'credit'          => $request->semester_credit[$key] ?? null,
                'credit_points'   => $request->semester_credit_points[$key] ?? null,
                // 'sgpa'            => $request->sgpa ?? null,
                'created_at'      => now(),

            ]);
        }
    }


    if ($request->attendance_subject) {
    foreach ($request->attendance_subject as $key => $subject) {
        DB::table('attendance_records')->insert([
            'mentoring_info_id' => $mentoringInfoId,
            'subject'      => $subject,
            'jan'          => $request->jan[$key] ?? null,
            'feb'          => $request->feb[$key] ?? null,
            'mar'          => $request->mar[$key] ?? null,
            'apr'          => $request->apr[$key] ?? null,
            'may'          => $request->may[$key] ?? null,
            'jun'          => $request->jun[$key] ?? null,
            'jul'          => $request->jul[$key] ?? null,
            'aug'          => $request->aug[$key] ?? null,
            'sep'          => $request->sep[$key] ?? null,
            'oct'          => $request->oct[$key] ?? null,
            'nov'          => $request->nov[$key] ?? null,
            'dec'          => $request->dec[$key] ?? null,
            'created_at'   => now(),
        ]);
    }
}


    $languages = $request->language; // array of language names
    $proficiencies = $request->language_proficiency; // array of proficiencies

    if (is_array($languages) && is_array($proficiencies)) {
        foreach ($languages as $index => $lang) {
            if (!empty($lang) && isset($proficiencies[$index])) {
                DB::table('communication_patterns')->insert([
                    'mentoring_info_id' => $mentoringInfoId,
                    'language' => $lang,
                    'proficiency' => $proficiencies[$index],
                    'created_at' => now(),

                ]);
            }
        }
    }

    $body_language_type = $request->body_language_type; // array of language names
    $body_language_value = $request->body_language_value; // array of proficiencies

    if (is_array($body_language_type) && is_array($body_language_value)) {
        foreach ($body_language_type as $index => $lang) {
            if (!empty($lang) && isset($body_language_value[$index])) {
                DB::table('communication_pattern2')->insert([
                    'mentoring_info_id' => $mentoringInfoId,
                    'body_language' => $lang,
                    'type' => $body_language_value[$index],
                    'created_at' => now(),

                ]);
            }
        }
    }

    return redirect()->route('user.mentoring')->with('success','Mentoring info updated successfully.');

     }



    public function userProfile(){
        $title = "User Profile";
        $student = DB::table('users')->where('id',Session::get('userid'))->first();
        return view('student.student-profile',['title' => $title, 'student' => $student]);
    }

    public function addmentoring(){
        $title = 'Add Mentoring Info';
        $sessions = DB::table('academic_sessions')->orderBy('id','desc')->get();
          $student = DB::table('users')->where('id',Session::get('userid'))->first();
        return view('student.add-mentoring',['title' => $title, 'sessions' => $sessions, 'student' => $student]);
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


    public function getSubjects($semester_id)
{
    // dd($semester_id);
    $subjects = DB::table('subject')
        ->select('subject_name', 'subject_code')
        ->where('semester_id', $semester_id)
        ->where('subject_type', 'theory')
        ->get();
    // dd($subjects);
    return response()->json($subjects);
}


public function getPracticalSubjects($semester_id)
{
    $subjects = DB::table('subject')
        ->where('semester_id', $semester_id)
        ->where('subject_type', 'practical') // Assumes you distinguish types
        ->select('subject_name', 'subject_code')
        ->get();
    // dd($subjects);
    return response()->json($subjects);
}


public function getSemesterSubjects($semester_id)
{
    $subjects = DB::table('subject')
        ->where('semester_id', $semester_id)
        // ->where('subject_type', 'theory')
        ->select('subject_name', 'subject_code')
        ->get();

    return response()->json($subjects);
}


public function getAttendanceSubjects($semester_id)
{
    $subjects = DB::table('subject')
        ->where('semester_id', $semester_id)
        // ->where('subject_type', 'theory')
        ->select('subject_name', 'subject_code')
        ->get();

    return response()->json($subjects);
}


public function addMentoringStore(Request $request){

    // dd($request->all());
    $request->validate([

        'session'    => 'required|string|max:255',
        'department' => 'required|string|max:255',
        'semester'   => 'required|string|max:255',


        'subject'       => 'required|array|min:1',
        'subject.*'     => 'required|string|max:255',
        'paper_code'    => 'required|array|min:1',
        'paper_code.*'  => 'required|string|max:100',
        'ca1'           => 'nullable|array',
        'ca1.*'         => 'nullable|integer|min:0|max:25',
        'ca2'           => 'nullable|array',
        'ca2.*'         => 'nullable|integer|min:0|max:25',
        'ca3'           => 'nullable|array',
        'ca3.*'         => 'nullable|integer|min:0|max:25',
        'ca4'           => 'nullable|array',
        'ca4.*'         => 'nullable|integer|min:0|max:25',


        'practical_subject'      => 'nullable|array|min:1',
        'practical_subject.*'    => 'required|string|max:255',
        'practical_code'         => 'nullable|array|min:1',
        'practical_code.*'       => 'required|string|max:100',
        'pca1'                   => 'nullable|array',
        'pca1.*'                 => 'nullable|integer|min:0|max:40',
        'pca2'                   => 'nullable|array',
        'pca2.*'                 => 'nullable|integer|min:0|max:40',


        'semester_subject'        => 'required|array|min:1',
        'semester_subject.*'      => 'required|string|max:255',
        'semester_subject_code'   => 'required|array|min:1',
        'semester_subject_code.*' => 'required|string|max:100',
        'semester_grade'          => 'nullable|array',
        'semester_grade.*'        => 'nullable|in:O,E,A,B,C,D,F',
        'semester_points'         => 'nullable|array',
        'semester_points.*'       => 'nullable|integer|min:0|max:10',
        'semester_credit'         => 'nullable|array',
        'semester_credit.*'       => 'nullable|min:0|max:10|numeric|regex:/^\d+(\.\d)?$/',
        'semester_credit_points'  => 'nullable|array',
        'semester_credit_points.*'=> 'nullable|numeric|min:0|max:100',
        'sgpa'                    => 'nullable|numeric|min:0|max:10',


        'attendance_subject'   => 'required|array|min:1',
        'attendance_subject.*' => 'required|string|max:255',
        'Jan'  => 'nullable|array',
        'Jan.*'=> 'nullable|integer|min:0|max:100',
        'Feb.*'=> 'nullable|integer|min:0|max:100',
        'Mar.*'=> 'nullable|integer|min:0|max:100',
        'Apr.*'=> 'nullable|integer|min:0|max:100',
        'May.*'=> 'nullable|integer|min:0|max:100',
        'Jun.*'=> 'nullable|integer|min:0|max:100',
        'Jul.*'=> 'nullable|integer|min:0|max:100',
        'Aug.*'=> 'nullable|integer|min:0|max:100',
        'Sep.*'=> 'nullable|integer|min:0|max:100',
        'Oct.*'=> 'nullable|integer|min:0|max:100',
        'Nov.*'=> 'nullable|integer|min:0|max:100',
        'Dec.*'=> 'nullable|integer|min:0|max:100',


        'language'              => 'nullable|array|min:1',
        'language.*'            => 'nullable|string|max:100',
        'language_proficiency'  => 'nullable|array',
        'language_proficiency.*'=> 'nullable',


        'body_language_type'    => 'nullable|array|min:1',
        'body_language_type.*'  => 'nullable|string|max:100',
        'body_language_value'   => 'nullable|array',
        'body_language_value.*' => 'nullable|in:Yes,No',


        'certifications'              => 'nullable|string',
        'workshops'                   => 'nullable|string',
        'competitions'                => 'nullable|string',
        'projects'                    => 'nullable|string',
        'extra_curricular_activities' => 'nullable|string',
        'cultural_activities'         => 'nullable|string',
        'club_memberships'            => 'nullable|string',
        'social_service_activities'   => 'nullable|string',
        'community_engagement'        => 'nullable|string',
    ]);


            $existing = DB::table('mentoring_infos')
            ->where('session_id', $request->session)
            ->where('department_id', $request->department)
            ->where('semester_id', $request->semester)
            ->where('user_id', Session::get('userid'))
            ->exists();

        if ($existing) {
            return redirect()->back()
                ->withErrors(['combination' => 'You have already submitted the mentoring information for this semester. You may update or edit the existing entry if needed.'])
                ->withInput();
        }


    $mentoringInfoId = DB::table('mentoring_infos')->insertGetId([
        'session_id' => $request->session,
        'department_id' => $request->department,
        'semester_id' => $request->semester,
        'user_id' => Session::get('userid'),
        'sgpa' => $request->sgpa,
        'certifications' => $request->certifications,
        'workshops' => $request->workshops,
        'competitions' => $request->competitions,
        'projects' => $request->projects,
        'sports_participation' => $request->sports_participation,
        'cultural_activities' => $request->cultural_activities,
        'club_memberships' => $request->club_memberships,
        'social_service_activities' => $request->social_service_activities,
        'community_engagement' => $request->community_engagement,
        'created_at' => now(),

    ]);

    if ($request->has('subject')) {
        foreach ($request->subject as $key => $subject) {
            DB::table('theory_exams')->insert([
                'mentoring_info_id' => $mentoringInfoId,
                'subject_name' => $subject,
                'paper_code' => $request->paper_code[$key],
                'ca1' => $request->ca1[$key],
                'ca2' => $request->ca2[$key],
                'ca3' => $request->ca3[$key],
                'ca4' => $request->ca4[$key],
                'created_at' => now(),

            ]);
        }
    }

     if ($request->practical_subject && $request->practical_code) {
        foreach ($request->practical_subject as $key => $subject) {
            DB::table('practical_exams')->insert([
                'mentoring_info_id' => $mentoringInfoId,
                'subject_name'        => $subject,
                'paper_code'     => $request->practical_code[$key],
                'pca1'           => $request->pca1[$key] ?? null,
                'pca2'           => $request->pca2[$key] ?? null,
                'created_at'     => now(),

            ]);
        }
    }

    if ($request->semester_subject && $request->semester_subject_code) {
        foreach ($request->semester_subject as $key => $subject) {
            DB::table('semester_marks')->insert([
                'mentoring_info_id' => $mentoringInfoId,
                'subject'         => $subject,
                'paper_code'      => $request->semester_subject_code[$key],
                'letter_grade'    => $request->semester_grade[$key] ?? null,
                'points'          => $request->semester_points[$key] ?? null,
                'credit'          => $request->semester_credit[$key] ?? null,
                'credit_points'   => $request->semester_credit_points[$key] ?? null,
                // 'sgpa'            => $request->sgpa ?? null,
                'created_at'      => now(),

            ]);
        }
    }


    if ($request->attendance_subject) {
        foreach ($request->attendance_subject as $key => $subject) {
            DB::table('attendance_records')->insert([
                'mentoring_info_id' => $mentoringInfoId,
                'subject'      => $subject,
                'Jan'          => $request->Jan[$key] ?? null,
                'Feb'          => $request->Feb[$key] ?? null,
                'Mar'          => $request->Mar[$key] ?? null,
                'Apr'          => $request->Apr[$key] ?? null,
                'May'          => $request->May[$key] ?? null,
                'Jun'          => $request->Jun[$key] ?? null,
                'Jul'          => $request->Jul[$key] ?? null,
                'Aug'          => $request->Aug[$key] ?? null,
                'Sep'          => $request->Sep[$key] ?? null,
                'Oct'          => $request->Oct[$key] ?? null,
                'Nov'          => $request->Nov[$key] ?? null,
                'Dec'          => $request->Dec[$key] ?? null,
                'created_at'   => now(),

            ]);
        }
    }


    $languages = $request->language; // array of language names
    $proficiencies = $request->language_proficiency; // array of proficiencies

    if (is_array($languages) && is_array($proficiencies)) {
        foreach ($languages as $index => $lang) {
            if (!empty($lang) && isset($proficiencies[$index])) {
                DB::table('communication_patterns')->insert([
                    'mentoring_info_id' => $mentoringInfoId,
                    'language' => $lang,
                    'proficiency' => $proficiencies[$index],
                    'created_at' => now(),

                ]);
            }
        }
    }

    $body_language_type = $request->body_language_type; // array of language names
    $body_language_value = $request->body_language_value; // array of proficiencies

    if (is_array($body_language_type) && is_array($body_language_value)) {
        foreach ($body_language_type as $index => $lang) {
            if (!empty($lang) && isset($body_language_value[$index])) {
                DB::table('communication_pattern2')->insert([
                    'mentoring_info_id' => $mentoringInfoId,
                    'body_language' => $lang,
                    'type' => $body_language_value[$index],
                    'created_at' => now(),

                ]);
            }
        }
    }

    return redirect()->back()->with('success', 'Mentoring info saved successfully! <a href="'.route('user.mentoring').'">Check Details</a>');


}


public function userImageUpdate(Request $request){

     $request->validate([
        'user_image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // 2MB
    ]);

    $userId = Session::get('userid');

    $oldImage = DB::table('users')->where('id', $userId)->value('user_image');


    if ($oldImage && File::exists(public_path('img/' . $oldImage))) {
        File::delete(public_path('img/' . $oldImage));
    }

    $imagename = time() . '.' . $request->user_image->extension();
    $request->user_image->move(public_path('img'), $imagename);

    DB::table('users')->where('id', $userId)->update([
        'user_image' => $imagename,
    ]);

    return redirect()->back()->with('success', 'Profile picture updated successfully.');
}


public function passwordUpdate(Request $request){

     $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:8|confirmed',
        'password_confirmation' => 'required'
    ]);

    $userId = Session::get('userid');

    $currentHashedPassword = DB::table('users')->where('id', $userId)->value('password');

     if (!Hash::check($request->current_password, $currentHashedPassword)) {
        return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

     $newHashedPassword = Hash::make($request->password);

         DB::table('users')->where('id', $userId)->update([
        'password' => $newHashedPassword,
    ]);

    Auth::logout();
    Session::flush();

    return redirect('/')->with('success', 'Password updated successfully. Please login again.');

}

}
