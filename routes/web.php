<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\Teacher\TaskController;
use App\Http\Controllers\Student\TaskSubmissionController;

// ======================= Home & Login
Route::get('/', fn() => view('home'))->name('home');
Route::get('/login', fn() => view('login'))->name('login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

// ======================= Student Routes
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {

    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [StudentController::class, 'updateProfile'])->name('profile.update');

    Route::get('/supervisor-info', [StudentController::class, 'supervisorInformation'])->name('supervisor.information');
    Route::post('/supervisor-info', [StudentController::class, 'supervisorUpdate'])->name('supervisor.update');

    // Student Queries
    Route::get('/queries', [QueryController::class, 'studentQueries'])->name('queries');
    Route::post('/queries/store', [QueryController::class, 'storeStudentQuery'])->name('queries.store');

    // ✅ Assigned Tasks Page (student er assigned task view)
    Route::get('/assign-tasks', [StudentController::class, 'assignTasks'])->name('assign-tasks');

    // ✅ Submit Task
    Route::post('/task-submit/{taskId}', [TaskSubmissionController::class, 'submit'])->name('task.submit');

    // ✅ Download Student Submission
    Route::get('/submission/download/{id}', [TaskSubmissionController::class, 'downloadSubmission'])->name('submissions.download');
});

Route::middleware(['auth'])->prefix('teacher')->name('teacher.')->group(function () {

    Route::get('/dashboard', fn() => view('teacher.teacher-dashboard'))->name('dashboard');

    Route::get('/profile', fn() => view('teacher.profile'))->name('profile');

    // ✅ FIX THIS ROUTE
    Route::get('/student-progress-track', fn() => view('teacher.student-progress-track'))->name('student.progress.track');

    Route::get('/queries', [QueryController::class, 'teacherQueries'])->name('queries');
    Route::post('/queries/{id}/feedback', [QueryController::class, 'storeTeacherFeedback'])->name('queries.feedback');

    Route::get('/task-assign', [TaskController::class, 'create'])->name('task.assign');
    Route::post('/task-assign/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/task/download/{id}', [TaskController::class, 'downloadTask'])->name('tasks.download');

});