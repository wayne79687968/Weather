<?php

Route::middleware(['role:admin'])->group(function(){
    Route::get('admin/logs', 'LogsController@index')->name('logs.index');
});

Route::get('/logs/getWeatherLog', 'LogsController@getWeatherLog')->name('logs.getWeatherLog');
?>
