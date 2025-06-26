<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MentoringInfoController extends Controller
{
    public function mentoring(){


        $mentee_id = DB::table('assigned_mentor')
        ->join('student_details','assigned_mentor.mentee_id','=','student_details.id')
        ->join('users','student_details.user_id','=','users.id')
        ->select('users.id')
        ->where('assigned_mentor.mentor_id',Session::get('userid'))
         ->pluck('users.id');

        // dd($mentee_id);

          $mentoring = DB::table('mentoring_infos')
        ->join('academic_sessions','mentoring_infos.session_id','=','academic_sessions.id')
        ->join('department','mentoring_infos.department_id','=','department.id')
        ->join('academic_semisters','mentoring_infos.semester_id','=','academic_semisters.id')
        ->join('users','mentoring_infos.user_id','=','users.id')
        ->select('mentoring_infos.*',DB::raw('DATE(mentoring_infos.created_at) as created_date'),'academic_sessions.session','department.department_name','academic_semisters.semister_name','users.name','users.user_image')
        ->whereIn('mentoring_infos.user_id', $mentee_id)
        // ->orderBy('mentoring_infos.id','desc')
        ->orderBy('mentoring_infos.status', 'asc')
        ->orderBy('mentoring_infos.updated_at', 'desc')
        ->get();
        // dd($mentoring);

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
    // dd($pendingMentoringCount);

        $sessions = DB::table('academic_sessions')->orderBy('id','desc')->get();

        return view('admin.admin_mentoring',['mentoring' => $mentoring, 'pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount, 'sessions' => $sessions]);
    }


     public function getDepartments(Request $request)
    {
        $sessionId = $request->input('session_id');

        $departments = DB::table('department')
            ->where('session_id', $sessionId) // adjust if there's a relation
            ->select('id', 'department_name')
            ->get();

        return response()->json($departments);
    }

  public function getSemesters(Request $request)
{
    $departmentId = $request->input('department_id');
    $sessionId = $request->input('session_id');

    $semesters = DB::table('academic_semisters')
        ->where('department_id', $departmentId)
        ->where('session_id', $sessionId)
        ->select('id', 'semister_name') // ✅ use correct column name
        ->get();

    return response()->json($semesters);
}




public function filter(Request $request)
{
    $request->validate([
        'session_id' => 'required|integer',
        'department_id' => 'required|integer',
        'semester_id' => 'required|integer',
    ]);

    $mentee_id = DB::table('assigned_mentor')
        ->join('student_details', 'assigned_mentor.mentee_id', '=', 'student_details.id')
        ->join('users', 'student_details.user_id', '=', 'users.id')
        ->where('assigned_mentor.mentor_id', Session::get('userid'))
        ->pluck('users.id');

    $mentoring = DB::table('mentoring_infos')
        ->join('academic_sessions', 'mentoring_infos.session_id', '=', 'academic_sessions.id')
        ->join('department', 'mentoring_infos.department_id', '=', 'department.id')
        ->join('academic_semisters', 'mentoring_infos.semester_id', '=', 'academic_semisters.id')
        ->join('users', 'mentoring_infos.user_id', '=', 'users.id')
        ->select(
            'mentoring_infos.*',
            DB::raw('DATE(mentoring_infos.created_at) as created_date'),
            'academic_sessions.session',
            'department.department_name',
            'academic_semisters.semister_name',
            'users.name',
            'users.user_image'
        )
        ->whereIn('mentoring_infos.user_id', $mentee_id)
        ->where('mentoring_infos.session_id', $request->session_id)
        ->where('mentoring_infos.department_id', $request->department_id)
        ->where('mentoring_infos.semester_id', $request->semester_id)
        ->orderBy('mentoring_infos.status', 'asc')
        ->orderBy('mentoring_infos.updated_at', 'desc')
        ->get();

    // Encrypt IDs
    foreach ($mentoring as $item) {
        $item->encrypted_id = encrypt($item->id);
    }

    return response()->json(['data' => $mentoring]);
}




    public function mentoring_info_approval($id){
        $id = decrypt($id);

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

        return view('admin.mentoring_info_approval',['pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount, 'id' => $id]);
    }


    public function mentoringApprovalUpdate(Request $request, $id){
        $id = decrypt($id);

        $request->validate([
            'status' => 'required',
            'remark' => 'nullable'
        ]);

        DB::table('mentoring_infos')->where('id',$id)->update([
            'status' => $request->status,
            'remark' => $request->remark
        ]);

        return redirect()->route('admin_mentoring_data')->with('success','Mentoring Info updated successfully.');
    }


    public function mentoringInfoDelete($id){
        $id = decrypt($id);
        // dd($id);
        DB::table('mentoring_infos')->where('id',$id)->delete();
        return redirect()->back()->with('success','Mentoring info deleted successfully.');
    }


    public function mentoringInfoView($id){
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

        return view('admin.admin_mentoring_info', ['pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount, 'theory' => $theory, 'body_language' => $body_language, 'language' => $language, 'subjectAttendance' => $subjectAttendance, 'overallAttendance' => $overallAttendance, 'mentoring' => $mentoring, 'practical' => $practical, 'semesters' => $semesters]);
    }


     public function bulkDelete(Request $request){

         $request->validate([
            'selected_ids' => 'required|array|min:1',
            'selected_ids.*' => 'integer',
        ]);


       $deleteCount = DB::table('mentoring_infos')->whereIn('id', $request->selected_ids)->delete();

        return redirect()->back()->with('success', '</strong>'.$deleteCount.'</strong>'.' - Mentoring info have been deleted successfully.');
    }



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

        return view('admin.edit-mentoring-info', ['theory' => $theory,
        'pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount,
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
        // 'status' => '0',
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

    return redirect()->route('admin_mentoring_data')->with('success','Mentoring info updated successfully.');

     }
}
