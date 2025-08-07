<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TemplateController;



// route::get('/',[TemplateController::class,'index']);

Route::get('/', function () {
    return view('home');
})->name('home');


// Teacher Routes
Route::get('/teacher/teacher_dashboard', function () {
    return view('teacher.teacher_dashboard');
});


Route::get('/QMP_T', function () {
    return view('teacher.QMP_T');
});


Route::get('/student-progress-track', function () {
    return view('teacher.stdnt_prgrs_track');
});


Route::get('/student_dashboard', function () {
    return view('student.student_dashboard');
});


Route::get('/QMP_S', function () {
    return view('student.QMP_S');
});



// =================================

Route::get('/login', function () {
    return view('login');
})->name('login');


Route::get('/student-queries', function () {
    return view('teacher.QMP_T');
})->name('student.queries');


Route::get('/student-progress-track', function () {
    return view('teacher.stdnt_prgrs_track');
})->name('student.progress.track');


Route::get('/logout', function () {
    return view('teacher.logout');
})->name('logout');

Route::get('/notification', function () {
    return view('teacher.notification');
})->name('notification');

Route::get('/resource_sharing', function () {
    return view('student.resource_sharing');
})->name('resource_sharing');

Route::get('/task_assign', function () {
    return view('teacher.task_assign');
})->name('task_assign');

Route::get('/profile', function () {
    return view('teacher.profile');
})->name('profile');

// ===================================student

Route::get('/student-queries', function () {
    return view('student.QMP_S');
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


Route::get('/resource_sharing', function () {
    return view('student.resource_sharing');
})->name('resource_sharing');


Route::get('/task_assign', function () {
    return view('student.task_assign');
})->name('task_assign');