<?php

Route::get('/employees', ['as' => 'employees', 'uses' => 'EmployeeController@index']);
Route::get('/employees/create', ['as' => 'employees.create', 'uses' => 'EmployeeController@create']);
Route::get('/employees/edit/{employee}', ['as' => 'employee.edit', 'uses' => 'EmployeeController@edit']);
