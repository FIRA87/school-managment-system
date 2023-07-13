<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\FreeAmountController;
use App\Http\Controllers\Backend\Setup\FreeCategoryController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');

// User Manage All Routes
Route::prefix('users')->group(function () {
    Route::get('/view', [UserController::class, 'userView'])->name('user.view');
    Route::get('/add', [UserController::class, 'userAdd'])->name('users.add');
    Route::post('/store', [UserController::class, 'userStore'])->name('users.store');
    Route::get('/edit/{id}', [UserController::class, 'userEdit'])->name('users.edit');
    Route::post('/update/{id}', [UserController::class, 'userUpdate'])->name('users.update');
    Route::get('/delete/{id}', [UserController::class, 'userDelete'])->name('users.delete');
});

// USER PROFILE AND PASSWORD
Route::prefix('profile')->group(function () {
    Route::get('/view', [ProfileController::class, 'profileView'])->name('profile.view');
    Route::get('/edit', [ProfileController::class, 'profileEdit'])->name('profile.edit');
    Route::post('/store', [ProfileController::class, 'profileStore'])->name('profile.store');
    Route::get('/password/view', [ProfileController::class, 'passwordView'])->name('password.view');
    Route::post('/password/update', [ProfileController::class, 'passwordUpdate'])->name('password.update');
});


// STUDENT CLASS Routes
Route::prefix('setups')->group(function () {

    Route::get('student/class/view', [StudentClassController::class, 'viewStudent'])->name('student.class.view');
    Route::get('student/class/add', [StudentClassController::class, 'studentClassAdd'])->name('student.class.add');
    Route::post('student/class/store', [StudentClassController::class, 'studentClassStore'])->name('store.student.class');
    Route::get('student/class/edit/{id}', [StudentClassController::class, 'studentClassEdit'])->name('student.class.edit');
    Route::post('student/class/update/{id}', [StudentClassController::class, 'studentClassUpdate'])->name('update.student.class');
    Route::get('/student/class/delete/{id}', [StudentClassController::class, 'studentClassDelete'])->name('student.class.delete');

    // Student Year Routes
    Route::get('student/year/view', [StudentYearController::class, 'studentViewYear'])->name('student.year.view');
    Route::get('student/year/add', [StudentYearController::class, 'studentYearAdd'])->name('student.year.add');
    Route::post('student/year/store', [StudentYearController::class, 'studentYearStore'])->name('store.student.year');
    Route::get('student/year/edit/{id}', [StudentYearController::class, 'studentYearEdit'])->name('student.year.edit');
    Route::post('student/year/update/{id}', [StudentYearController::class, 'studentYearUpdate'])->name('update.student.year');
    Route::get('student/year/delete/{id}', [StudentYearController::class, 'studentYearDelete'])->name('student.year.delete');

    // Student Group Routes
    Route::get('student/group/view', [StudentGroupController::class, 'studentViewGroup'])->name('student.group.view');
    Route::get('student/group/add', [StudentGroupController::class, 'studentGroupAdd'])->name('student.group.add');
    Route::post('student/group/store', [StudentGroupController::class, 'studentGroupStore'])->name('store.student.group');
    Route::get('student/group/edit/{id}', [StudentGroupController::class, 'studentGroupEdit'])->name('student.group.edit');
    Route::post('student/group/update/{id}', [StudentGroupController::class, 'studentGroupUpdate'])->name('update.student.group');
    Route::get('student/group/delete/{id}', [StudentGroupController::class, 'studentGroupDelete'])->name('student.group.delete');

// Student Shift Routes
    Route::get('student/shift/view', [StudentShiftController::class, 'studentViewShift'])->name('student.shift.view');
    Route::get('student/shift/add', [StudentShiftController::class, 'studentShiftAdd'])->name('student.shift.add');
    Route::post('student/shift/store', [StudentShiftController::class, 'studentShiftStore'])->name('store.student.shift');
    Route::get('student/shift/edit/{id}', [StudentShiftController::class, 'studentShiftEdit'])->name('student.shift.edit');
    Route::post('student/shift/update/{id}', [StudentShiftController::class, 'studentShiftUpdate'])->name('update.student.shift');
    Route::get('student/shift/delete/{id}', [StudentShiftController::class, 'studentShiftDelete'])->name('student.shift.delete');

// Student Free Category Routes
    Route::get('free/category/view', [FreeCategoryController::class, 'freeCategoryView'])->name('free.category.view');
    Route::get('free/category/add', [FreeCategoryController::class, 'freeCategoryAdd'])->name('free.category.add');
    Route::post('free/category/store', [FreeCategoryController::class, 'freeCategoryStore'])->name('store.free.category');
    Route::get('free/category/edit/{id}', [FreeCategoryController::class, 'freeCategoryEdit'])->name('free.category.edit');
    Route::post('free/category/update/{id}', [FreeCategoryController::class, 'freeCategoryUpdate'])->name('update.free.category');
    Route::get('free/category/delete/{id}', [FreeCategoryController::class, 'freeCategoryDelete'])->name('free.category.delete');

    // Student Free Category AMOUNT Routes
    Route::get('fee/amount/view', [FreeAmountController::class, 'viewFreeAmount'])->name('fee.amount.view');
    Route::get('fee/amount/add', [FreeAmountController::class, 'feeAmountAdd'])->name('fee.amount.add');
    Route::post('fee/amount/store', [FreeAmountController::class, 'feeAmountStore'])->name('store.free.amount');
    Route::get('fee/amount/edit/{fee_category_id}', [FreeAmountController::class, 'feeAmountEdit'])->name('fee.amount.edit');
    Route::post('fee/amount/update/{fee_category_id}', [FreeAmountController::class, 'feeAmountUpdate'])->name('update.fee.amount');
    Route::get('fee/amount/detail/{fee_category_id}', [FreeAmountController::class, 'feeAmountDetail'])->name('fee.amount.details');

    // Student Exam Type
    Route::get('exam/type/view', [ExamTypeController::class, 'examTypeView'])->name('exam.type.view');
    Route::get('exam/type/add', [ExamTypeController::class, 'examTypeAdd'])->name('exam.type.add');
    Route::post('exam/type/store', [ExamTypeController::class, 'examTypeStore'])->name('store.exam.type');
    Route::get('exam/type/edit/{id}', [ExamTypeController::class, 'examTypeEdit'])->name('exam.type.edit');
    Route::post('exam/type/update/{id}', [ExamTypeController::class, 'examTypeUpdate'])->name('update.exam.type');
    Route::get('exam/type/delete/{id}', [ExamTypeController::class, 'examTypeDelete'])->name('exam.type.delete');

    // School Subject Routes
    Route::get('school/subject/view', [SchoolSubjectController::class, 'schoolSubjectView'])->name('school.subject.view');
    Route::get('school/subject/add', [SchoolSubjectController::class, 'schoolSubjectAdd'])->name('school.subject.add');
    Route::post('school/subject/store', [SchoolSubjectController::class, 'schoolSubjectStore'])->name('store.school.subject');
    Route::get('school/subject/edit/{id}', [SchoolSubjectController::class, 'schoolSubjectEdit'])->name('school.subject.edit');
    Route::post('school/subject/update/{id}', [SchoolSubjectController::class, 'schoolSubjectUpdate'])->name('update.school.subject');
    Route::get('school/subject/delete/{id}', [SchoolSubjectController::class, 'schoolSubjectDelete'])->name('school.subject.delete');

});
