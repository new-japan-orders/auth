<?php 

Route::get(
    'confirm_email/{confirmation_code}',
    'Auth\RegisterController@confirmEmail'
)->name('confirm.email');

Route::get('/test', function () {
    return view('auth::confirmed', ['user' => \App\Models\User::find(1)]);
});