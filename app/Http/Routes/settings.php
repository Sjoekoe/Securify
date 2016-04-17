<?php

Route::get('/settings', ['as' => 'user.settings', 'uses' => 'SettingController@index']);
