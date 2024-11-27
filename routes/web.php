<?php

use App\Http\Controllers\AcceptInvitationController;
use App\Models\Group;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


    Route::view('groups', 'groups.index')
    ->middleware(['auth'])
    ->name('groups.index');
    
    Route::get('groups/{group}', function (Group $group)  {
        if(!$group){
            abort(404);
        }
        return view("groups.view",compact("group"));
    })
    ->middleware(['auth'])
    ->name('groups.view');

    Route::get('testCalc', function ()  {
      $user= auth()->user();
      return $user->calculateUserPaymentForGroup(Group::find(61));
        
    });



Route::get('groups/invitation/{token}', AcceptInvitationController::class)
    ->middleware(['auth'])
    ->name('groups.accept-invitation');



    Route::view('test', 'test')
    ->middleware(['auth'])
    ->name('test');


require __DIR__.'/auth.php';
