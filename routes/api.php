<?php

use App\Http\Requests\CreateEmployeeFromImportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Employee Endpoints...
Route::group(['prefix' => 'employee'], function() {
    Route::post('', [\App\Http\Controllers\Api\EmployeeManagementsController::class, 'createFromImport']);
    Route::get('', [\App\Http\Controllers\Api\EmployeeManagementsController::class, 'index']);
    Route::get('{employee}', [\App\Http\Controllers\Api\EmployeeManagementsController::class, 'show']);
    Route::delete('{employee}', [\App\Http\Controllers\Api\EmployeeManagementsController::class, 'delete']);
});
