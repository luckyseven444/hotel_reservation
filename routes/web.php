<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Models\Room;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/dashboard', function () {
    $rooms = Room::all();
    return view('room.index', compact('rooms'));
})->middleware(['auth'])->name('dashboard');

Route::resources(['rooms' => RoomController::class]);

Route::get('/signin', function(){
    return view('auth.signin');
})->middleware('guest')->name('signin');

Route::post('signin', function(){
    if(auth()->guard('customer')->attempt(array('email' => request()->email, 'password' => request()->password)))
        {
            return redirect()->route('customer.index');   
        }else{
            return redirect()->route('signin')->with('error','Email-Address And Password Are Wrong.');
        }
});

Route::post('signout', function(){
    \Auth::logout();
    request()->session()->flush();
    return redirect()->route('signin');
})->name('signout');

Route::get('customer/index', [ReservationController::class, 'index'])->name('customer.index');
Route::get('reservation/{room}', [ReservationController::class, 'getForm'])->name('reservation.form');
Route::post('reservation/{room}', [ReservationController::class, 'reserve'])->name('reserve');
require __DIR__.'/auth.php';