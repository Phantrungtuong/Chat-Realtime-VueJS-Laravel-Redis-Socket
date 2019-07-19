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

use App\User;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/', function() {
//    return view('chat');
//})->middleware('auth');

Route::get('/getUserLogin', function() {
    return Auth::user();
})->middleware('auth');

Route::get('/getUserInfo', function (){
    $user = App\User::where('id', \Illuminate\Support\Facades\Auth::user()->id)->first();
    return $user;
})->middleware('auth');

Route::get('/messages', function() {
    $messages = App\Message::with('user')->orderBy('id', 'desc')->limit(300)->get()->reverse()->values();
    return $messages;
})->middleware('auth');

Route::post('/messages', function() {
    $user = Auth::user();
    $message = $user->messages()->create(['message' => request()->get('message')]);
    broadcast(new App\Events\MessagePosted($message, $user))->toOthers();
    return ['status' => 'OK'];
})->middleware('auth');


