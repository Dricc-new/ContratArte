<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\EnterpriseController;
use App\Http\Controllers\UserController;
use App\Models\Contract;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Barryvdh\DomPDF\Facade\Pdf;
use Ramsey\Uuid\Uuid;

    
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


Route::get('/test', function(){
    return 'test';
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('home');

    Route::controller(ContractController::class)->prefix('/Contratos/')->name('contract.')->group(function(){
        Route::get('Edit','edit')->name('edit');
        Route::post('Edit','post')->name('post');
        
        Route::get('Info','info')->name('info');
        Route::get('Buscar','search')->name('list');
    });
    
    Route::controller(EnterpriseController::class)->prefix('/Empresas/')->name('enterprise.')->group(function(){
        Route::get('Edit','edit')->name('edit');
        Route::post('Edit','post')->name('post');
        
        Route::get('Info','info')->name('info');
        Route::get('Lista','search')->name('list');
    });

    
    Route::prefix('/Usuario/')->name('user.')->group(function(){
        Route::get('Nuevo',UserController::class)->name('new');
        Route::post('Nuevo',[UserController::class,'post'])->name('new.post');
        Route::get('Editar/{id}',[UserController::class,'edit'])->name('edit');
        Route::get('Lista',[UserController::class,'list'])->name('list');
    });
    
    Route::get('/Search',function(){
        return Inertia::render('Contract/Search');
    })->name('search');
});
