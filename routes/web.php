<?php

use App\Models\Session;
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
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	Route::get('/hostel/{id}', ['as' => 'view.hostel', 'uses' => 'App\Http\Controllers\HostelController@view']);
	Route::get('/hostels', ['as' => 'hostels', 'uses' => 'App\Http\Controllers\HostelController@index']);
	Route::get('/room_data/get/{id}', ['as' => 'get.roomData', 'uses' => 'App\Http\Controllers\RoomController@getData']);
	Route::post('/book_room', ['as' => 'book.room', 'uses' => 'App\Http\Controllers\BookingController@store']);
	Route::get('/student/{page}', [App\Http\Controllers\PageController::class, 'studentPages'])->name('get.pages');

});


Route::group(['middleware' => 'admin'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
	Route::post('/admin_hostels/create', ['as' => 'hostel.create', 'uses' => 'App\Http\Controllers\HostelController@store']);
	Route::get('/admin_hostels/view/{id}', ['as' => 'hostel.view', 'uses' => 'App\Http\Controllers\HostelController@view']);
	Route::post('/create_room/{id}', ['as' => 'room.create', 'uses' => 'App\Http\Controllers\RoomController@store']);
	Route::post('/admin_hostels/edit/{id}', ['as' => 'hostel.edit', 'uses' => 'App\Http\Controllers\HostelController@edit']);
	Route::post('/admin_hostels/delete/{id}', ['as' => 'hostel.delete', 'uses' => 'App\Http\Controllers\HostelController@destroy']);
	Route::post('/admin_room/edit/{id}', ['as' => 'room.edit', 'uses' => 'App\Http\Controllers\RoomController@edit']);
	Route::post('/admin_room/delete/{id}', ['as' => 'room.delete', 'uses' => 'App\Http\Controllers\RoomController@destroy']);
	Route::post('/admin_sessions/add', ['as' => 'session.create', 'uses' => 'App\Http\Controllers\SessionController@store']);
	Route::post('/admin_sessions/edit/{id}', ['as' => 'session.edit', 'uses' => 'App\Http\Controllers\SessionController@update']);
	Route::post('/admin_sessions/delete/{id}', function ($id) {
		App\Models\Session::destroy($id);
		$notification = ['message'=>'Deleted successfully', 'alert-type' =>'success'];
		return redirect('/admin_sessions',)->with($notification);
	});
	
});

