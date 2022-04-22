<?php
Route::post('admin/users/{user}/update', 'UsersController@update')->name('user.profile.update');
Route::delete('admin/users/{user}/delete', 'UsersController@delete')->name('user.delete');

Route::middleware(['role:admin'])->group(function(){
    Route::get('admin/users', 'UsersController@index')->name('users.index');
    Route::put('users/{user}/attach', 'UsersController@attach')->name('user.role.attach');
    Route::put('users/{user}/detach', 'UsersController@detach')->name('user.role.detach');
});

Route::middleware(['can:view,user'])->group(function(){
    Route::get('/admin/users/{user}/profile', 'UsersController@show')->name('user.profile.show');
});

?>
