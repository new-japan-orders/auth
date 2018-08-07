<?php 

Route::get('confirm_email/{confirmation_code}', 'Auth\RegisterController@confirmEmail')->name('confirm.email');
