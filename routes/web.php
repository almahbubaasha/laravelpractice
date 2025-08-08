<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TemplateController;

// ================================== Home

Route::get('/', function () {
    return view('home');
})->name('home');



// Route::get('/QMP_S', function () {
//     return view('student.QMP_S');
// });



Route::get('/login', function () {
    return view('login');
})->name('login');


// ================================== Teacher
Route::get('/teacher/teacher-dashboard', function () {
    return view('teacher.teacher-dashboard');
})->name('teacher.dashboard');


Route::get('/teacher/student-queries', function () {
    return view('teacher.QMP-Teacher');
})->name('teacher.student.queries');

Route::get('/teacher/student-progress-track', function () {
    return view('teacher.student-progress-track');
})->name('teacher.student.progress.track');

Route::get('/teacher/logout', function () {
    return view('teacher.logout');
})->name('teacher.logout');

Route::get('/teacher/notification', function () {
    return view('teacher.notification');
})->name('teacher.notification');

Route::get('/teacher/resource-sharing', function () {
    return view('teacher.resource-sharing');
})->name('teacher.resource.sharing');


Route::get('/teacher/task-assign', function () {
    return view('teacher.task-assign');
})->name('teacher.task.assign');

Route::get('/teacher/profile', function () {
    return view('teacher.profile');
})->name('teacher.profile');



// ===================================student

Route::get('/student-dashboard', function () {
    return view('student.student-dashboard');
})->name('student.dashboard');



Route::get('/student-queries', function () {
    return view('student.QMP-Student');
})->name('student.queries');

Route::get('/logout', function () {
    return view('student.logout');
})->name('logout');


Route::get('/notification', function () {
    return view('student.notification');
})->name('notification');


Route::get('/profile', function () {
    return view('student.profile');
})->name('profile');


Route::get('/resource-sharing', function () {
    return view('student.resource-sharing');
})->name('resource.sharing');


Route::get('/task_assign', function () {
    return view('student.task-assign');
})->name('task.assign');

Route::get('/supervisor-information', function () {
    return view('student.supervisor-information');
})->name('supervisor.information');