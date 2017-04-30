<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => '/notes'], function () {
    Route::get('/', 'NoteController@index');
    Route::get('/{note}', 'NoteController@show');
    Route::post('/', 'NoteController@store');
    Route::patch('/{note}', 'NoteController@update');
    Route::delete('/{note}', 'NoteController@destroy');
});
