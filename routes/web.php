<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    return view('welcome');
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('Dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/myschool', function () {
    return view('MySchool');
})->middleware(['auth'])->name('myschool');

Route::get('/manageusers', function () {
    return view('users.ManageUsers');
})->middleware(['auth'])->name('manageusers');

Route::get('/myprofile', function () {
    return view('users.MyProfile');
})->middleware(['auth'])->name('myprofile');

Route::get('/classes', function () {
    return view('academics.Classes');
})->middleware(['auth'])->name('classes');

Route::get('/grades', function () {
    return view('academics.Grades');
})->middleware(['auth'])->name('grades');

Route::get('/subjects', function () {
    return view('academics.Subjects');
})->middleware(['auth'])->name('subjects');

Route::get('/termandyear', function () {
    return view('academics.TermsAndYears');
})->middleware(['auth'])->name('termandyear');

Route::get('/exams', function () {
    return view('academics.Exams');
})->middleware(['auth'])->name('exams');

Route::get('/studentAdmission', function () {
    return view('admissions.StudentAdmission');
})->middleware(['auth'])->name('studentAdmission');


Route::post('/school.create', [\App\Http\Controllers\SchoolController::class, 'store'])
    ->middleware('auth')
    ->name('school.create');

Route::get('/school.get_school', [\App\Http\Controllers\SchoolController::class, 'get_school'])
    ->middleware('auth')
    ->name('school.get_school');

Route::post('/profile.update', [\App\Http\Controllers\UserController::class, 'update_profile'])
    ->middleware('auth')
    ->name('profile.update');

Route::post('/users.create', [\App\Http\Controllers\UserController::class, 'store'])
    ->middleware('auth')
    ->name('users.create');

Route::get('/users.get', [\App\Http\Controllers\UserController::class, 'get_users'])
    ->middleware('auth')
    ->name('users.get');

Route::get('/users.get_one/{id}', [\App\Http\Controllers\UserController::class, 'find_one_user'])
    ->middleware('auth')
    ->name('users.get_one');

Route::get('/users.reset/{id}', [\App\Http\Controllers\UserController::class, 'reset_user'])
    ->middleware('auth')
    ->name('users.reset');

Route::post('/section.create', [\App\Http\Controllers\SectionController::class, 'store'])
    ->middleware('auth')
    ->name('section.create');

Route::get('/section.get_active', [\App\Http\Controllers\SectionController::class, 'get_active_sections'])
    ->middleware('auth')
    ->name('section.get_active');

Route::post('/grade.create', [\App\Http\Controllers\GradeController::class, 'store'])
    ->middleware('auth')
    ->name('grade.create');

Route::get('/grade.get', [\App\Http\Controllers\GradeController::class, 'get_grades'])
    ->middleware('auth')
    ->name('grade.get');

Route::get('/grade.get_one/{id}', [\App\Http\Controllers\GradeController::class, 'find_one_grade'])
    ->middleware('auth')
    ->name('grade.get_one');

Route::get('/grade.get_active', [\App\Http\Controllers\GradeController::class, 'get_active_grades'])
    ->middleware('auth')
    ->name('grade.get_active');

Route::get('/grade.toggle/{id}', [\App\Http\Controllers\GradeController::class, 'toggle_grade'])
    ->middleware('auth')
    ->name('grade.toggle');

Route::post('/classes.create', [\App\Http\Controllers\ClasessController::class, 'store'])
    ->middleware('auth')
    ->name('classes.create');

Route::get('/classes.get', [\App\Http\Controllers\ClasessController::class, 'get_classs'])
    ->middleware('auth')
    ->name('classes.get');

Route::get('/classes.get_one/{id}', [\App\Http\Controllers\ClasessController::class, 'find_one_clas'])
    ->middleware('auth')
    ->name('classes.get_one');

Route::get('/classes.toggle/{id}', [\App\Http\Controllers\ClasessController::class, 'toggle_clas'])
    ->middleware('auth')
    ->name('classes.toggle');

Route::post('/subject.create', [\App\Http\Controllers\SubjectController::class, 'store'])
    ->middleware('auth')
    ->name('subject.create');

Route::get('/subject.get', [\App\Http\Controllers\SubjectController::class, 'get_subjects'])
    ->middleware('auth')
    ->name('subject.get');

Route::get('/subject.get_one/{id}', [\App\Http\Controllers\SubjectController::class, 'find_one_subject'])
    ->middleware('auth')
    ->name('subject.get_one');

Route::get('/subject.toggle/{id}', [\App\Http\Controllers\SubjectController::class, 'toggle_subject'])
    ->middleware('auth')
    ->name('subject.toggle');

Route::post('/year.create', [\App\Http\Controllers\YearController::class, 'store'])
    ->middleware('auth')
    ->name('year.create');

Route::get('/year.get', [\App\Http\Controllers\YearController::class, 'get_years'])
    ->middleware('auth')
    ->name('year.get');

Route::get('/year.get_active', [\App\Http\Controllers\YearController::class, 'get_active_years'])
    ->middleware('auth')
    ->name('year.get_active');

Route::get('/year.toggle/{id}', [\App\Http\Controllers\YearController::class, 'toggle_year'])
    ->middleware('auth')
    ->name('year.toggle');

Route::post('/term.create', [\App\Http\Controllers\TermController::class, 'store'])
    ->middleware('auth')
    ->name('term.create');

Route::get('/term.get', [\App\Http\Controllers\TermController::class, 'get_terms'])
    ->middleware('auth')
    ->name('term.get');

Route::get('/term.get_one/{id}', [\App\Http\Controllers\TermController::class, 'find_one_term'])
    ->middleware('auth')
    ->name('term.get_one');

Route::get('/term.toggle/{id}', [\App\Http\Controllers\TermController::class, 'toggle_term'])
    ->middleware('auth')
    ->name('term.toggle');

Route::post('/exam.create', [\App\Http\Controllers\ExamController::class, 'store'])
    ->middleware('auth')
    ->name('exam.create');

Route::get('/exam.get', [\App\Http\Controllers\ExamController::class, 'get_exams'])
    ->middleware('auth')
    ->name('exam.get');

Route::get('/exam.get_one/{id}', [\App\Http\Controllers\ExamController::class, 'find_one_exam'])
    ->middleware('auth')
    ->name('exam.get_one');

Route::get('/exam.toggle/{id}', [\App\Http\Controllers\ExamController::class, 'toggle_exam'])
    ->middleware('auth')
    ->name('exam.toggle');

require __DIR__.'/auth.php';
