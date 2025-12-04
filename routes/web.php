<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Teacher\TeacherStudentController;
use App\Http\Controllers\Teacher\TeacherProfileController;
use App\Http\Controllers\Teacher\NotificationController as TeacherNotificationController;
use App\Http\Controllers\Student\NotificationController as StudentNotificationController;
use App\Http\Controllers\Teacher\ResourceController as TeacherResourceController;
use App\Http\Controllers\Student\ResourceController as StudentResourceController;
use App\Http\Controllers\Teacher\TaskController as TeacherTaskController;
use App\Http\Controllers\Student\TaskController as StudentTaskController;
use App\Http\Controllers\Student\StudentQueryController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\TeacherQueryController;


// ======================= Home & Login
Route::get('/', fn() => view('home'))->name('home');
Route::get('/login', fn() => view('login'))->name('login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');


// ======================= Register
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.post');



/// ======================= STUDENT ROUTES
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [StudentController::class, 'updateProfile'])->name('profile.update');

    // Supervisor Info
    Route::get('/supervisor-info', [StudentController::class, 'supervisorInformation'])->name('supervisor.information');
    Route::post('/supervisor-info', [StudentController::class, 'supervisorUpdate'])->name('supervisor.update');

    // Queries
    Route::get('/queries', [QueryController::class, 'studentQueries'])->name('queries');
    Route::post('/queries/store', [QueryController::class, 'storeStudentQuery'])->name('queries.store');

    // QMP - Student Query Management
     Route::get('/queries', [App\Http\Controllers\Student\StudentQueryController::class, 'index'])->name('queries');
    Route::post('/queries/store', [App\Http\Controllers\Student\StudentQueryController::class, 'store'])->name('queries.store');
    Route::delete('/queries/{id}', [App\Http\Controllers\Student\StudentQueryController::class, 'destroy'])->name('queries.destroy');
    Route::delete('/queries/replies/{id}', [App\Http\Controllers\Student\StudentQueryController::class, 'deleteReply'])->name('queries.replies.destroy');
    
    // Student Notifications
    Route::get('/notifications', [StudentNotificationController::class, 'index'])->name('notification');
    Route::get('/notifications/list', [StudentNotificationController::class, 'list'])->name('notifications.list');
    Route::delete('/notifications/{id}', [StudentNotificationController::class, 'delete'])->name('notifications.delete');
    Route::post('/notifications/{id}/read', [StudentNotificationController::class, 'markAsRead'])->name('notifications.read');

    // Student Resources
    Route::get('/resource-sharing', [StudentResourceController::class, 'index'])->name('resource.sharing');
    Route::get('/resources/list', [StudentResourceController::class, 'list'])->name('resources.list');
    Route::get('/resources/download/{id}', [StudentResourceController::class, 'download'])->name('resources.download');
    Route::delete('/resources/{id}', [StudentResourceController::class, 'delete'])->name('resources.delete');

    // ======================= STUDENT TASK ROUTES (UPDATED) =======================
    // Assigned Tasks Page (View)
   // Student Task Routes

    // Assigned Tasks Page
    Route::get('/assigned-tasks', [StudentTaskController::class, 'index'])->name('tasks.index');
    
    // Submit Task
    Route::post('/task/{id}/submit', [StudentTaskController::class, 'submit'])->name('task.submit');
    
    // Delete Submission
    Route::delete('/task/{id}', [StudentTaskController::class, 'delete'])->name('task.delete');


    // ======================= STUDENT LOGOUT =======================
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});




// ======================= TEACHER ROUTES
Route::middleware(['auth'])->prefix('teacher')->name('teacher.')->group(function () {

    // Dashboard
    //Route::get('/dashboard', fn() => view('teacher.teacher-dashboard'))->name('dashboard');
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');

    
    // Profile
    Route::get('/profile', [TeacherProfileController::class, 'showProfile'])->name('profile');//
    Route::post('/profile/save', [TeacherProfileController::class, 'saveProfile'])->name('profile.save');

    // Resource Sharing (Teacher)
    Route::get('/resource-sharing', [TeacherResourceController::class, 'index'])->name('resource.sharing');
    Route::post('/resources/share', [TeacherResourceController::class, 'share'])->name('resources.share');
    Route::get('/resources/list', [TeacherResourceController::class, 'list'])->name('resources.list');
    Route::get('/resources/download/{id}', [TeacherResourceController::class, 'download'])->name('resources.download');
    Route::delete('/resources/{id}', [TeacherResourceController::class, 'delete'])->name('resources.delete');

    

    // Teacher Queries
    Route::get('/queries', [QueryController::class, 'teacherQueries'])->name('queries');
    Route::post('/queries/{id}/feedback', [QueryController::class, 'storeTeacherFeedback'])->name('queries.feedback');


    // QMP - Teacher Query Management
    Route::get('/student-queries', [TeacherQueryController::class, 'index'])->name('student.queries');
    Route::post('/student-queries/{id}/reply', [TeacherQueryController::class, 'reply'])->name('student.queries.reply');
    Route::delete('/student-queries/{id}', [TeacherQueryController::class, 'deleteQuery'])->name('student.queries.destroy');
    Route::delete('/student-queries/replies/{id}', [TeacherQueryController::class, 'deleteReply'])->name('student.queries.replies.destroy');

    
    // ======================= TEACHER TASK ROUTES (UPDATED) =======================
    // Task Assignment Page (Form + List)
    Route::get('/task-assign', [TeacherTaskController::class, 'create'])->name('task.assign');
    Route::post('/task/store', [TeacherTaskController::class, 'store'])->name('task.store');
    
    // Task Management
    Route::get('/tasks', [TeacherTaskController::class, 'index'])->name('tasks.index');
    Route::delete('/task/{task}', [TeacherTaskController::class, 'destroy'])->name('task.destroy');
    
    // Submission Management
    Route::get('/task/submission/{assignment}/download', [TeacherTaskController::class, 'downloadSubmission'])->name('task.submission.download');
    Route::delete('/task/submission/{assignment}', [TeacherTaskController::class, 'deleteSubmission'])->name('task.submission.delete');
    
    // Task File Download
    Route::get('/task/{task}/download', [TeacherTaskController::class, 'downloadTaskFile'])->name('task.download');
    

    // =========================================Teacher Add Student==================
    Route::get('/add-student', [TeacherStudentController::class, 'index'])->name('add.student');
    Route::post('/add-student', [TeacherStudentController::class, 'store'])->name('add.student.store');

    // AJAX: View Student Profile
    Route::get('/student-profile/{studentId}', [TeacherStudentController::class, 'getStudentProfile'])->name('student.profile');

    // Teacher Notifications
    Route::get('/notifications', [TeacherNotificationController::class, 'index'])->name('notification');
    Route::post('/notifications/send', [TeacherNotificationController::class, 'send'])->name('notifications.send');

    // Logout
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

});