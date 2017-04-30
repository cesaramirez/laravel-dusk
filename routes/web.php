<?php

$router->get('/', function () {
    return view('welcome');
});

$router->auth();

$router->get('/home', 'HomeController@index')->name('home');

$router->group(['prefix' => '/notes'], function ($router) {
    $router->get('/', 'NoteController@index');
    $router->get('/{note}', 'NoteController@show');
    $router->post('/', 'NoteController@store');
    $router->patch('/{note}', 'NoteController@update');
    $router->delete('/{note}', 'NoteController@destroy');
});
