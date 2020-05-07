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

Route::get('/sample', function () {
    return view('sample');
});


Route::get('/folders/create', 'FolderController@create')->name('folders.create');
Route::post('/folders/create', 'FolderController@store')->name('folders.store');


Route::get('/folders/{folder_id}/tasks', 'TaskController@index')->name('tasks.index');

Route::get('/folders/{folder_id}/tasks/create', 'TaskController@create')->name('tasks.create');
Route::post('/folders/{folder_id}/tasks/create', 'TaskController@store')->name('tasks.store');

Route::get('/folders/{folder_id}/tasks/{task_id}/edit', 'TaskController@edit')->name('tasks.edit');
Route::post('/folders/{folder_id}/tasks/{task_id}/edit', 'TaskController@update');

Route::post('/folders/{folder_id}/tasks/{task}', 'TaskController@delete')->name('tasks.delete');