<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ChangeRequest;
use App\Models\StudentDetail;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use App\Models\ProfileChangeRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class ChangeRequestController extends Controller
{
    public function index()
    {
        // Get all requests with user, student, and mentor details
        $requests = ProfileChangeRequest::select(
                'profile_change_requests.*',
                'students.name as student_name',
                'mentors.name as mentor_name'
            )
            ->join('users as students', 'profile_change_requests.user_id', '=', 'students.id')
            ->leftJoin('users as mentors', 'profile_change_requests.mentor_id', '=', 'mentors.id')
            ->orderBy('profile_change_requests.created_at', 'desc')
            ->paginate(10);

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

        return view('admin.change-requests.index', compact('requests','pendingUpdateRequestCount','pendingMentoringCount'));
    }

    public function show($id)
    {
        // Get the request with user, student, and mentor details
        $request = ProfileChangeRequest::select(
                'profile_change_requests.*',
                'students.name as student_name',
                'students.email as student_email',
                'mentors.name as mentor_name'
            )
            ->join('users as students', 'profile_change_requests.user_id', '=', 'students.id')
            ->leftJoin('users as mentors', 'profile_change_requests.mentor_id', '=', 'mentors.id')
            ->where('profile_change_requests.id', $id)
            ->first();

        if (!$request) {
            return redirect()->route('admin.change-requests.index')
                ->with('error', 'Change request not found.');
        }

        // Get student details
        $student = DB::table('student_details')
            ->select(
                'student_details.*',
                'users.name',
                'users.email',
                'users.contact',
                'department.department_name'
            )
            ->join('users', 'student_details.user_id', '=', 'users.id')
            ->leftJoin('department', 'users.department', '=', 'department.id')
            ->where('student_details.id', $request->student_id)
            ->first();

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

        return view('admin.change-requests.show', compact('request', 'student','pendingUpdateRequestCount','pendingMentoringCount'));
    }

    public function approve($id)
    {
        $request = ProfileChangeRequest::findOrFail($id);

        if ($request->status !== 'pending') {
            return redirect()->route('admin.change-requests.show', $id)
                ->with('error', 'This request has already been processed.');
        }

        // Get student details
        $student = DB::table('student_details')
            ->where('id', $request->student_id)
            ->first();

        if (!$student) {
            return redirect()->route('admin.change-requests.show', $id)
                ->with('error', 'Student not found.');
        }

        // Apply changes
        $changes = $request->changes;
        $updateData = [];
        $userUpdateData = [];

        foreach ($changes as $field => $value) {
            // Handle fields that go in the users table
            if ($field === 'name') {
                $userUpdateData[$field] = $value['to'];
            } else {
                $updateData[$field] = $value['to'];
            }
        }

        // Update student details
        if (!empty($updateData)) {
            DB::table('student_details')
                ->where('id', $request->student_id)
                ->update($updateData);
        }

        // Update user details if necessary
        if (!empty($userUpdateData)) {
            DB::table('users')
                ->where('id', $request->user_id)
                ->update($userUpdateData);
        }

        // Clear student cache
        Cache::forget('student_details_' . $request->user_id);

        // Update request status
        $request->status = 'approved';
        $request->processed_at = Carbon::now();
        $request->save();

        return redirect()->route('admin.change-requests.show', $id)
            ->with('success', 'Change request has been approved and changes have been applied.');
    }

    public function reject(Request $request, $id)
    {
        $changeRequest = ProfileChangeRequest::findOrFail($id);

        if ($changeRequest->status !== 'pending') {
            return redirect()->route('admin.change-requests.show', $id)
                ->with('error', 'This request has already been processed.');
        }

        // Validate rejection reason
        $request->validate([
            'reject_reason' => 'required|string|max:255',
        ]);

        // Update request status
        $changeRequest->status = 'rejected';
        $changeRequest->reject_reason = $request->reject_reason;
        $changeRequest->processed_at = Carbon::now();
        $changeRequest->save();

        return redirect()->route('admin.change-requests.show', $id)
            ->with('success', 'Change request has been rejected.');
    }
}
