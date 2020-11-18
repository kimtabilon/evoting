<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', ['as' => 'front', 'uses' => 'App\Http\Controllers\FrontController@front']);
Route::post('start', ['as' => 'start', 'uses' => 'App\Http\Controllers\FrontController@sheet']);
Route::post('vote', ['as' => 'vote', 'uses' => 'App\Http\Controllers\FrontController@vote']);

//Route::get('/',[HomeController::class, 'index'])->name('home');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
		Route::get('students/{municipality?}', ['as' => 'students', 'uses' => 'App\Http\Controllers\VotingController@students']);
		Route::post('students/new', ['as' => 'students.new', 'uses' => 'App\Http\Controllers\VotingController@newStudent']);
		Route::get('students/delete/{id}', ['as' => 'students.delete', 'uses' => 'App\Http\Controllers\VotingController@deleteStudent']);

		Route::get('candidates', ['as' => 'candidates', 'uses' => 'App\Http\Controllers\VotingController@candidates']);
		Route::post('candidates/new', ['as' => 'candidates.new', 'uses' => 'App\Http\Controllers\VotingController@newCandidate']);
		Route::get('candidates/delete/{id}', ['as' => 'candidates.delete', 'uses' => 'App\Http\Controllers\VotingController@deleteCandidate']);

		Route::get('votes', ['as' => 'votes', 'uses' => 'App\Http\Controllers\VotingController@votes']);
		Route::get('reset', ['as' => 'reset', 'uses' => 'App\Http\Controllers\VotingController@reset']);
		Route::post('import', ['as' => 'import', 'uses' => 'App\Http\Controllers\VotingController@import']);

		Route::get('rules', ['as' => 'rules', 'uses' => 'App\Http\Controllers\VotingController@rules']);
		Route::post('rules/new', ['as' => 'rules.new', 'uses' => 'App\Http\Controllers\VotingController@newRule']);
		Route::post('rules/sort', ['as' => 'rules.sort', 'uses' => 'App\Http\Controllers\VotingController@sortRules']);
		Route::get('rules/delete/{id}', ['as' => 'rules.delete', 'uses' => 'App\Http\Controllers\VotingController@deleteRule']);
});

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

