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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/task', ["as" => "task", function () {
    return view('form');
}]);

Route::get('videos', 'App\Http\Controllers\VideoController@index')->name('videos');
Route::get('videos/play/{id}', 'App\Http\Controllers\VideoController@play')->name('videos.play');
Route::post('upload', 'App\Http\Controllers\VideoController@upload')->name('videos.upload');
