<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\PropertyTypeController;

// Route::get('/', function () {
//     return view('welcome');
// });

//User Frontend All Route
Route::get('/', [UserController::class, 'Index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// USER GROUP MIDDLEWARE
Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
});//END USER GROUP MIDDLEWARE

require __DIR__.'/auth.php';

//ADMIN GROUP MIDDLEWARE
Route::middleware(['auth','role:admin'])->group(function (){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
});//END GROUP ADMIN MIDDLEWARE
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');


//AGENT GROUP MIDDLEWARE
Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
});//END GROUP AGENT MIDDLEWARE


//ADMIN GROUP MIDDLEWARE
Route::middleware(['auth','role:admin'])->group(function (){
    
    //Property amenities AllType Route
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/type','AllType')->name('all.type');
        Route::get('/add/type','AddType')->name('add.type');
        Route::post('/store/type','StoreType')->name('store.type');
        Route::get('/edit/type/{id}','EditType')->name('edit.type');
        Route::post('/update/type','UpdateType')->name('update.type');
        Route::get('/delete/type/{id}','DeleteType')->name('delete.type');
    });  

       //Amenities All  Route
       Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/amenities','AllAmenities')->name('all.amenities');
        Route::get('/add/amenities','AddAmenities')->name('add.amenities');
        Route::post('/store/amenities','StoreAmenities')->name('store.amenities');
        Route::get('/edit/amenities/{id}','EditAmenities')->name('edit.amenities');
        Route::post('/update/amenities','UpdateAmenities')->name('update.amenities');
        Route::get('/delete/amenities/{id}','DeleteAmenities')->name('delete.amenities');
    });  
});//END GROUP ADMIN MIDDLEWARE

