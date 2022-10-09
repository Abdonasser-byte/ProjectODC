<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAdminController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::any('/AddStudent/{name}/{courseName}/{email}', [AdminController::class, 'AddStudent']);
Route::any('/Addcourse/{nameCourses}/{courseperiod}', [AdminAdminController::class, 'Addcourse']);
Route::any('/AddSupplier/{nameSuppliers}', [AdminAdminController::class, 'AddSupplier']);
Route::any('/SupplierCourse/{suppliersname}/{coursename}/{costofcourse}', [AdminAdminController::class, 'SupplierCourse']);
Route::any('/PaidToCompany/{suppliersname}/{coursename}/{cost}', [AdminAdminController::class, 'PaidToCompany']);
Route::any('/updatestudentattends/{name}/{courseName}', [AdminController::class, 'updatestudentattends']);
Route::any('/updatestudentfinsh/{name}/{courseName}', [AdminController::class, 'updatestudentfinsh']);
Route::any('/updatestudenttask/{name}/{courseName}', [AdminController::class, 'updatestudenttask']);
Route::any('/AddSkills/{nameSkills}', [AdminAdminController::class, 'AddSkills']);
Route::any('/courseskills/{coursename}/{skills?}', [AdminAdminController::class, 'courseskills']);
Route::any('/AddAdmin/{Fname}/{Lname}/{email}/{password}', [AdminAdminController::class, 'AddAdmin']);
Route::any('/prerequistecourse/{name}/{skills?}', [AdminAdminController::class, 'prerequistecourse']);
Route::any('/StudentReg/{courseName}/{SetOfSkill?}', [StudentController::class, 'StudentReg']);
