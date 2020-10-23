<?php

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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('create_meeting');
});
Route::post('/', 'zoomController@CreateMeeting_Send');
Route::get('/', 'zoomController@createMeeting_view_page');

Route::post('/', 'zoomController@createMeeting');

Route::get('/meetings-list', 'zoomController@meetingsList');
Route::get('/delete/{id}', 'zoomController@deleteMeeting');

Route::get('/meeting', 'zoomController@startmeet');
// Route::get('/meeting', function () {
//     return view('startMeeting');
// });

