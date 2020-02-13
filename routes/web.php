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

Route::get('/', 'ContactsController@index');
Route::resource('contacts', 'ContactsController');
Route::get('files/{path}/{file}', function($path = null, $file = null) {
    $path = storage_path().'/files/'.$path.'/'.$file;
    if(file_exists($path)) {
        return Response::download($path);
    }
});
