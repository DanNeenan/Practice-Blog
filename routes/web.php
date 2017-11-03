<?php

Route::get('/', 'PostsController@index')->name('home');
Route::get('/posts/create', 'PostsController@create');
Route::post('/posts', 'PostsController@store');

Route::get('/posts/{post}', 'PostsController@show');
Route::delete('/posts/{post}', 'PostsController@destroy');

//works


Route::get('/posts/tags/{tag}', 'TagsController@index');
Route::post('/posts/tags', 'TagsController@store');

Route::post('/posts/{post}/comments', 'CommentsController@store');

// Route::get('/register', 'AuthController@register');
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');


// Route::get('/login', 'AuthController@login');
Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');


Route::get('/profiles/settings', 'ProfilesSettingsController@show');
Route::get('/profiles/settings/change-password', 'ProfilesSettingsController@showChangePassword');
Route::post('/profiles/settings/change-password', 'ProfilesSettingsController@updatePassword');

Route::get('/profiles/settings/change-email', 'ProfilesSettingsController@showChangeEmail');
Route::Post('/profiles/settings/change-email', 'ProfilesSettingsController@updateEmail');

Route::get('/profiles/settings/change-username', 'ProfilesSettingsController@showChangeUsername');
Route::post('/profiles/settings/change-username', 'ProfilesSettingsController@updateUsername');

Route::get('/profiles/settings/delete-account', 'ProfilesSettingsController@showDeleteAccount');
Route::delete('/profiles/settings/delete-account', 'ProfilesSettingsController@destroy');


Route::get('/profiles/{username}', 'ProfilesController@show');
Route::post('/profiles/{username}', 'ProfilesController@update_avatar');
Route::post('/profiles/{username}', 'ProfilesController@update_about');

Route::get('/users', 'ProfilesController@index');


// Route::get('/', 'ProfilesController@getRoles');


Route::post('/profiles/{username}/subscriptions', 'ProfilesSubscriptionController@store');

//search bar functions?
// Route::get('/', 'SearchController@search');



