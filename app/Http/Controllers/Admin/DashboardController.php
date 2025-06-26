<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function adminDashboard(){

        $admin = DB::table('users')->where('usertype', 'Admin')->count();
        $mentee = DB::table('users')->where('usertype','Student')->count();
        $mentor = DB::table('users')->where('usertype','Mentor')->count();

        // dd($mentee);

       $mentorlessStudentsCount = DB::table('users')
    ->where('usertype', 'Student')
    ->whereNotIn('id', function($query) {
        $query->select('student_details.user_id')
              ->from('assigned_mentor')
              ->join('student_details', 'assigned_mentor.mentee_id', '=', 'student_details.id');
    })
    ->count();

    $assigned_mentor = DB::table('assigned_mentor')
    ->where('mentor_id',Session::get('userid'))
    ->count();

    $pendingCount = DB::table('mentoring_infos')
    ->where('status', 0)
    ->whereIn('user_id', function($query) {
        $query->select('student_details.user_id')
              ->from('assigned_mentor')
              ->join('student_details', 'assigned_mentor.mentee_id', '=', 'student_details.id')
              ->where('assigned_mentor.mentor_id', Session::get('userid'));
    })
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


       $mentee_id = DB::table('assigned_mentor')
        ->join('student_details','assigned_mentor.mentee_id','=','student_details.id')
        ->join('users','student_details.user_id','=','users.id')
        ->select('users.id')
        ->where('assigned_mentor.mentor_id',Session::get('userid'))
         ->pluck('users.id');

        // dd($mentee_id);

         $pendingMentoringCount = DB::table('mentoring_infos')
    ->where('mentoring_infos.status', '0')
    ->whereIn('mentoring_infos.user_id', $mentee_id)
    ->count();

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
        ->limit(10)
        ->get();

          $mentees_info_admin = DB::table('users')
        ->select('users.id','users.name','users.email','users.contact', 'users.user_image', 'department.department_name')
        ->join('department', 'users.department', '=', 'department.id')
        ->where('users.usertype', 'Student')
        ->orderBy('users.id', 'desc')
        ->limit(10)
        ->get();

        return view('admin.index', ['admin' => $admin, 'pendingMentoringCount' => $pendingMentoringCount, 'mentees_info_admin' => $mentees_info_admin, 'mentoring' => $mentoring, 'pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingCount' => $pendingCount, 'assigned_mentor' => $assigned_mentor, 'mentee' => $mentee, 'mentor' => $mentor, 'mentorlessStudentsCount' => $mentorlessStudentsCount]);
    }
}
