<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
//Route::resource('/ticket', 'TicketController');
Route::get('/tickets/create', 'TicketController@create')->name('ticket.create');
Route::post('/tickets/create', 'TicketController@store')->name('ticket.store');
Route::get('/tickets/{id}/show', 'TicketController@show')->name('ticket.show');
Route::get('/tickets/{id}/edit', 'TicketController@edit')->name('ticket.edit');
Route::get('/tickets/{ticket}/Delete', 'TicketController@destroy')->name('ticket.delete');
Route::patch('/tickets/{id}/update', 'TicketController@update')->name('ticket.update');
Route::get('/tickets/{id}/file', 'TicketController@file')->name('ticket.file');


Route::get('/tickets/dashboard', 'TicketController@dashboard')->name('ticket.dashboard');
Route::get('/tickets/admin', 'TicketController@admin')->name('ticket.admin');
Route::get('/tickets/report', 'TicketController@report')->name('ticket.report');
Route::get('/tickets/{id}/showadmin', 'TicketController@showadmin')->name('ticket.showadmin');
Route::patch('/tickets/{id}/comment', 'TicketController@comment')->name('ticket.comment');
Route::get('/tickets/users', 'TicketController@users')->name('ticket.users');
Route::patch('/tickets/{id}/complete', 'TicketController@complete')->name('ticket.complete');
Route::patch('/tickets/{id}/incomplete', 'TicketController@incomplete')->name('ticket.incomplete');
Route::patch('/tickets/{id}/complete1', 'TicketController@complete1')->name('ticket.complete1');
Route::patch('/tickets/{id}/incomplete1', 'TicketController@incomplete1')->name('ticket.incomplete1');
Route::patch('/tickets/{id}/close', 'TicketController@close')->name('ticket.close');

Route::get('/', function () {
   return redirect('/login');
});



Route::post('/upload', 'UserController@uploadAvatar');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
