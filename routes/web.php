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

/*
Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('/', 'HomeController@index');

Auth::routes();


/* Profile */
Route::get('/user/{username}', 'ProfileController@viewProfile')->name('viewProfile');
Route::get('/user/{username}/edit', 'ProfileController@editProfile');
Route::post('/user/{username}/edit', 'ProfileController@commitEdit')->name('updateProfile');

/* Calendar, Events and Pre Reg */
Route::get('/calendar', 'CalendarController@viewCalendar')->name('viewCalendar');
Route::get('/calendar/add-event', 'CalendarController@viewAddEventForm');
Route::post('/calendar/add-event', 'CalendarController@createEvent')->name('createEvent');
Route::get('/calendar/edit-event/{id}', 'CalendarController@viewEditEventForm');
Route::post('/calendar/edit-event/{id}', 'CalendarController@updateEvent')->name('updateEvent');
Route::get('/calendar/delete-event/{id}', 'CalendarController@deleteEvent');
Route::get('/calendar/event/{id}', 'CalendarController@viewEvent')->name('viewEvent');



/* Static pages */
Route::get('/faq', function(){
	return view('faq');
});
Route::get('/eboard', function(){
	return view('eboard');
});
Route::get('/downloads', function(){
	return view('downloads');
});
