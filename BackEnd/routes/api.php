<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\SupplyChainController;
use App\Http\Controllers\MatterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\NoteController;
/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

Route::post('register',[Auth::class,'register']);
Route::post('login',[Auth::class ,'login']);
Route::get('user',[Auth::class,'user']);
Route::group([
    "middleware"=>["auth:api"]
],function (){
    Route::get('profile',[Auth::class,'profile']);
    Route::get('logout',[Auth::class,'logout']);
    Route::prefix('supplychain')->group(function () {
        Route::post('/', [SupplyChainController::class, 'AddSupplyChain']);
        Route::get('/all', [SupplyChainController::class, 'GetAllSuppliChain']);
        Route::put('/update/{id}', [SupplyChainController::class, 'UpdateSupplyChain']);
        Route::delete('/delete/{id}', [SupplyChainController::class, 'DelettSupplyChain']);
    });
    Route::prefix('matter')->group(function () {
        Route::post('/{idsupply}', [MatterController::class, 'AddMatter']);
        Route::get('/all/{idsupply}', [MatterController::class, 'GetAllMatters']);
        Route::put('/update/{idMatter}', [MatterController::class, 'UpdateMatter']);
        Route::delete('/delete/{idMatter}', [MatterController::class, 'DeleteMatter']);
    });
    Route::prefix('student')->group(function () {
        Route::post('/add/{idsupply}', [StudentController::class, 'createStudent']);
        Route::get('/all/{idsupply}', [StudentController::class, 'getAllStudents']);
        Route::put('/update/{idStudent}', [StudentController::class, 'updateStudent']);
        Route::delete('/delete/{idStudent}', [StudentController::class, 'deleteStudent']);
    });
    Route::prefix('note')->group(function () {
        Route::get('/getMatter/{idSupplyChain}/{idStudent}', [NoteController::class, 'GetMattersBySupplyChain']);
        Route::post('/add/{idSupplyChain}/{idStudent}', [NoteController::class, 'AddMattersNotes']);
        Route::put('/update/{idStudent}', [StudentController::class, 'updateStudent']);
        Route::delete('/delete/{idStudent}', [StudentController::class, 'deleteStudent']);
    });
});
