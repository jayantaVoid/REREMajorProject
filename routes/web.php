<?php


use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});
Auth::routes(['verify' => true]);
Route::namespace ('Admin')->controller(AdminController::class)->middleware('auth')->as('admin.')->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::get('/students', 'studentList')->name('student');
    Route::get('/add-student', 'addStudent')->name('addstudent');
    Route::post('/storestudent', 'storeStudent')->name('storestudent');
    Route::get('/grid', 'showGrid')->name('showgrid');
    Route::match(['get','post'],'/status', 'updateStatus')->name('update-status');
    Route::get('/getdata', 'getStudentsData')->name('get-student-data');
    Route::get('/edit-data/{id}', 'editStudentInfo')->name('editstudent');
    Route::post('/updatedata', 'updateStudentInfo')->name('updatestudent');
    Route::get('/delete-data/{id}','deleteStudentInfo')->name('deletestudent');
    Route::post('/search', 'searchData')->name('search');
    Route::get('/trash', 'trashedData')->name('trash-data');
    Route::get('restore/{id}','restoreData')->name('restore-data');
    Route::get('/profile/{id}','adminProfile')->name('profile');
    Route::post('/update-password','adminUpdatePassword')->name('update-password');
    // departments route call
    Route::get('/department-list','listDepartment')->name('department');
    Route::get('/add-department','addDepartment')->name('department-add');
    Route::post('/add-department','storeDepartment')->name('add-department');
    //teachers route call
    Route::get('/teacher','teachersList')->name('teacher');
    Route::get('/add-teacher','addTeacher')->name('teacher-add');
    Route::post('/add-teacher','storeTeacher')->name('teacher-store');
    Route::get('/general/{id}','isGeneral')->name('general');
    Route::get('/hod/{id}','isHod')->name('hod');
    Route::post('/status','changeStatus')->name('status');
    Route::get('/teacher-profile/{id}','showTeachersProfile')->name('teacher-profile');
    Route::get('/edit/teacher/{id}','editTeachersData')->name('edit-teacher');
});
Route::get('/user/home', [AdminController::class, 'userDashboard'])->name('userdashboard');
