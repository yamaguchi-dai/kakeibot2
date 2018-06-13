<?php


Route::post('/', 'Api\LineController@main');

Route::post('/LineInterface','Api\LineInterface\index@request');

