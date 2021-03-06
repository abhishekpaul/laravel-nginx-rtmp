<?php

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
function isUserAgent($type) {
        return stripos($_SERVER['HTTP_USER_AGENT'],$type);
}

Route::get('/logout', function() {
        if(Auth::check()) {
                Auth::logout();
        }
        return redirect('/')->with('saved', 'Logged out successfully.');
});
Route::pattern('streamName', '[a-zA-Z0-9\-]+');
Route::pattern('playbackToken', '[a-zA-Z0-9\-]+');
Route::pattern('playbackTime', '[0-9]+');
Route::pattern('id', '[0-9]+');
Route::get('/', 'DashboardController@index');
Route::get('/player/{streamName}', 'PlayerController@player');
Route::get('/auth', 'StreamController@auth');
Route::any('/stream/create', 'StreamController@create');
Route::get('/stream/{id}/delete', 'StreamController@delete');
Route::any('/stream/{id}/edit', 'StreamController@edit');
Route::get('/stream/{streamName}', 'PlayerController@info');
Route::get('/stream/{streamName}/{playbackToken}', 'PlayerController@tracker');
Route::get('/stream/{streamName}/{playbackToken}/{playbackTime}', 'PlayerController@updateTrackerPlayback');
Route::get('/stream/{streamName}/{playbackToken}/{playbackTime}/finished', 'PlayerController@updateTrackerFinished');
Route::any('/user/create', 'UserController@create');
Route::any('/user/{id}/password', 'UserController@updatePassword');
