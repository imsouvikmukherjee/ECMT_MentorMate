<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    public function department(){

        $departments = DB::table('department')->orderBy('id','desc')->paginate(5);

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


        return view('admin.department', ['pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount, 'departments' => $departments]);
    }

    public function addDepartment(){

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

        return view('admin.add-department',['pendingUpdateRequestCount' => $pendingUpdateRequestCount, 'pendingMentoringCount' => $pendingMentoringCount]);
    }

    public function addDepartmentStore(Request $request){
        $validate = $request->validate([
            'department_name' => 'required|string|unique:department,department_name',
            'description' => 'nullable'
        ]);

        DB::table('department')->insert([
            'department_name' => $validate['department_name'],
            'description' => $validate['description']
        ]);

        return redirect()->route('department')->with('success','<strong>'.$validate['department_name'].'</strong> - Department added successfully');
    }


    // DepartmentController.php
public function destroy($id)
{
    $id = decrypt($id);
    DB::table('department')->where('id',$id)->delete();
    return redirect()->route('department')->with('success','Department Deleted Successfully!');
}

}
