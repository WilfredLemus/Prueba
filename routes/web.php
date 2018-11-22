<?php


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function(){
    return "Home";
});

Route::get('/usuarios', 'UserController@index')->name('users.index');

Route::get('/usuarios/{user}', 'UserController@show')
    ->where('user', '[0-9]+')->name('users.show');

Route::get('/usuarios/nuevo', 'UserController@create')->name("users.create");

Route::get('/usuarios/{user}/editar', 'UserController@edit')
    ->where('user', '[0-9]+')->name("users.edit");

Route::put('/usuarios/{user}', 'UserController@update')
    ->where('user', '[0-9]+')->name('users.update');

Route::get('/usuarios/{user}/eliminar', 'UserController@delete')
    ->where('user', '[0-9]+')->name('users.delete');

Route::delete('/usuarios/{user}', 'UserController@destroy')
    ->where('user', '[0-9]+')->name('users.destroy');

Route::post('/usuarios', 'UserController@store')->name('users.store');

Route::get('/saludo/{name}/{nickname?}', 'WelcomeUserController');
