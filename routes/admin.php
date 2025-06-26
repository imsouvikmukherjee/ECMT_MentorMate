<?php

use App\Http\Controllers\Admin\AssignedmentorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\MenteeController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ChangeRequestController;
use App\Http\Controllers\Admin\AcademicDetailsController;
use App\Http\Controllers\Admin\MentoringInfoController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth','isStudent')->group(function () {
Route::get('/admin/dashboard',[DashboardController::class,'adminDashboard'])->name('admin_dashboard');
// Comment out the old department routes
// Route::get('/admin/department',[DepartmentController::class,'department'])->name('department');
// Route::get('/admin/add-department',[DepartmentController::class,'addDepartment'])->name('add_department');
// Route::post('/admin/add-department-store',[DepartmentController::class,'addDepartmentStore'])->name('add_department_store');
// Route::get('/delete-department/{id}', [DepartmentController::class, 'destroy']);

Route::get('/admin/subjects',[SubjectController::class,'subject'])->name('subject');
Route::get('/admin/add-subject',[SubjectController::class,'addSubject'])->name('add_subject');
Route::post('/admin/add-subject-store',[SubjectController::class,'addSubjectStore'])->name('add_subject_store');
Route::get('/admin/subjects/subject-delete/{id}',[SubjectController::class,'subjectDelete']);

// Subject assignment routes
Route::get('/admin/assign-subjects', [SubjectController::class, 'assignSubjects'])->name('assign.subjects');
Route::get('/admin/students-by-department', [SubjectController::class, 'getStudentsByDepartment']);
Route::get('/admin/subjects-by-department', [SubjectController::class, 'getSubjectsByDepartment']);
Route::post('/admin/assign-subjects-store', [SubjectController::class, 'assignSubjectsStore'])->name('assign.subjects.store');
Route::get('/get-departments/subjects', [SubjectController::class, 'getDepartments'])->name('getDepartments');
Route::get('/get-semesters/subjects', [SubjectController::class, 'getSemesters'])->name('getSemesters');


Route::get('/get-departments', [MentoringInfoController::class, 'getDepartments'])->name('mentoring.getDepartments');
Route::get('/get-semesters', [MentoringInfoController::class, 'getSemesters'])->name('mentoring.getSemesters');
Route::post('/admin/mentoring/filter', [MentoringInfoController::class, 'filter'])->name('admin.mentoring.filter');

Route::get('/admin/mentoring-update/{id}',[MentoringInfoController::class,'mentoringUpdate']);
Route::post('/admin/mentoring-update-store/{id}',[MentoringInfoController::class,'mentoringUpdateStore']);

Route::get('/admin/users',[UserController::class,'adminUser'])->name('admin_user');
Route::get('/admin/add-user',[UserController::class,'addUser'])->name('add_user');
Route::post('/admin/add-user-store',[UserController::class,'addUserStore'])->name('add_user_store');
Route::get('/admin/user-delete/{id}',[UserController::class,'userDelete']);
Route::get('admin/reset-password/{id}',[UserController::class,'resetPassword'])->name('reset_password');
Route::post('admin/reset-password-store/{id}',[UserController::class,'resetPasswordStore'])->name('reset_password_store');
Route::get('/admin/add-mentees',[MenteeController::class,'addMentee'])->name('add_mentee');
Route::post('/admin/add-mentees-store',[MenteeController::class,'addMenteeStore'])->name('add_mentee_store');
Route::get('/admin/mentees',[MenteeController::class,'mentees'])->name('mentee');
Route::get('/admin/mentee-delete/{id}',[MenteeController::class,'menteeDelete'])->name('mentee_delete');
Route::get('/admin/mentee-modify/{id}',[MenteeController::class,'editMentee'])->name('edit_mentee');
Route::post('/admin/modify-mentee/store/{id}',[MenteeController::class,'editMenteeStore'])->name('edit_mentee_store');
Route::get('/admin/mentee-info/{id}',[MenteeController::class,'menteeInfo'])->name('mentee_info');
Route::post('/admin/mentees/bulk-delete', [MenteeController::class, 'bulkDelete'])->name('mentees.bulk-delete');
Route::get('/get-departments-by-session', [MenteeController::class, 'getDepartmentsBySession'])->name('get.departments.by.session.mentee');

Route::get('/admin/view-assigned-mentors',[AssignedmentorController::class,'viewAssignedMentor'])->name('view_assign_mentors');
Route::get('/admin/assign-mentor',[AssignedmentorController::class,'assignMentor'])->name('assign_mentors');
Route::post('/filter-mentees', [AssignedmentorController::class, 'filterMentees'])->name('filter.mentees');
Route::post('/assign-mentor/store', [AssignedmentorController::class, 'assignMentorStore'])->name('assign.mentors.store');
Route::get('/admin/assign-mentor-delete/{id}', [AssignedmentorController::class, 'assignMentorDelete']);
Route::post('/admin/assigned-mentees/bulk-delete', [AssignedmentorController::class, 'bulkDelete'])->name('assignedmentees.bulk-delete');

Route::get('/get-departments-by-session-for-filter', [AssignedmentorController::class, 'getDepartmentsBySession'])->name('get.departments.by.session.filter');


Route::get('/admin/assign-mentees',[AssignedmentorController::class,'viewAssignMentees'])->name('view_assign_mentees');

Route::get('/admin/profile-change-request',[AssignedmentorController::class,'changeRequest'])->name('change_request');
Route::get('/admin/profile-change-request-delete/{id}',[AssignedmentorController::class,'changeRequestDelete']);
Route::get('/admin/change-request-approval/{id}',[AssignedmentorController::class,'changeRequestApproval'])->name('change_request_approval');
Route::post('/admin/change-request-approval-store/{id}',[AssignedmentorController::class,'changeRequestApprovalStore'])->name('change_request_approval_store');

// Change Requests Management
Route::get('/change-requests', [ChangeRequestController::class, 'index'])->name('admin.change-requests');
Route::get('/change-requests/{id}', [ChangeRequestController::class, 'show'])->name('admin.change-requests.show');
Route::post('/change-requests/{id}/approve', [ChangeRequestController::class, 'approve'])->name('admin.change-requests.approve');
Route::post('/change-requests/{id}/reject', [ChangeRequestController::class, 'reject'])->name('admin.change-requests.reject');

Route::get('/admin/mentoring',[MentoringInfoController::class,'mentoring'])->name('admin_mentoring_data');
Route::get('/admin/mentoring-info-approval/{id}',[MentoringInfoController::class,'mentoring_info_approval']);
Route::post('/admin/mentoring-info-approval-update/{id}',[MentoringInfoController::class,'mentoringApprovalUpdate']);
Route::get('/admin/mentoring-info-delete/{id}',[MentoringInfoController::class,'mentoringInfoDelete']);
Route::get('/admin/mentoring-info-view/{id}',[MentoringInfoController::class,'mentoringInfoView']);

Route::post('/admin/mentoring-info/bulk-delete', [MentoringInfoController::class, 'bulkDelete'])->name('info.bulk-delete');

// Academic Details Routes
Route::prefix('admin')->group(function () {
    // Session routes
    Route::get('/session', [AcademicDetailsController::class, 'sessions'])->name('admin.sessions');
    Route::get('/session/add-session', [AcademicDetailsController::class, 'addSession'])->name('admin.sessions.add');
    Route::get('/session/delete-session/{id}', [AcademicDetailsController::class, 'deleteSession'])->name('admin.delete.session');
    Route::post('/session', [AcademicDetailsController::class, 'storeSession'])->name('admin.sessions.store');
    // Route::put('/session/{academicSession}', [AcademicDetailsController::class, 'updateSession'])->name('admin.sessions.update');
    // Route::delete('/session/{academicSession}', [AcademicDetailsController::class, 'destroySession'])->name('admin.sessions.destroy');

    // Department routes
    Route::get('/department', [AcademicDetailsController::class, 'departments'])->name('admin.departments');
    Route::get('/department/add-department', [AcademicDetailsController::class, 'addDepartment'])->name('admin.departments.add');
    Route::get('department/delete-department/{id}', [AcademicDetailsController::class, 'deleteDepartment'])->name('admin.departments.delete');
    Route::post('/department', [AcademicDetailsController::class, 'storeDepartment'])->name('admin.departments.store');
    // Route::put('/department/{department}', [AcademicDetailsController::class, 'updateDepartment'])->name('admin.departments.update');
    // Route::delete('/department/{department}', [AcademicDetailsController::class, 'destroyDepartment'])->name('admin.departments.destroy');
    // Route::get('/department/by-session/{sessionId}', [AcademicDetailsController::class, 'getDepartmentsBySession'])->name('admin.departments.by-session');
    Route::get('/get-departments-by-session', [AcademicDetailsController::class, 'getDepartmentsBySession'])->name('get.departments.by.session');

    // Semester routes
    Route::get('/semester', [AcademicDetailsController::class, 'semesters'])->name('admin.semesters');
    Route::get('/semester/add-semester', [AcademicDetailsController::class, 'addSemester'])->name('admin.semesters.add');
    Route::get('/semester/semester-delete/{id}', [AcademicDetailsController::class, 'deleteSemester'])->name('admin.semesters.delete');
    Route::post('/semester', [AcademicDetailsController::class, 'storeSemester'])->name('admin.semesters.store');
    // Route::put('/semester/{semester}', [AcademicDetailsController::class, 'updateSemester'])->name('admin.semesters.update');
    // Route::delete('/semester/{semester}', [AcademicDetailsController::class, 'destroySemester'])->name('admin.semesters.destroy');
});

});


