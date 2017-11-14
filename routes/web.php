<?php

Route::get('/', 'PostsController@index')->name('home');

Route::prefix('posts')->group(function() {
    Route::post('/', 'PostsController@store');
    Route::get('/create', 'PostsController@create');
    Route::get('/{post}', 'PostsController@show');
    Route::delete('/{post}', 'PostsController@destroy');

    Route::prefix('/{post}')->group(function() {
        Route::post('/picture', 'PhotosController@store');

        Route::prefix('/comments')->group(function() {
            Route::post('/', 'CommentsController@store');
            Route::get('/{comment}/favourites', 'FavouritesController@store');
        });
    });

    Route::prefix('/tags')->group(function() {
        Route::get('/{tag}', 'TagsController@index');
        Route::post('/', 'TagsController@store');
    });
});

// Route::get('/register', 'AuthController@register');
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');


// Route::get('/login', 'AuthController@login');
Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');


Route::prefix('profiles')->group(function() {
    Route::get('/{username}', 'ProfilesController@show');
    Route::post('/{username}', 'ProfilesController@update_about');

    Route::prefix('settings')->group(function() {
        Route::get('/', 'ProfilesSettingsController@show');
        Route::get('/change-password', 'ProfilesSettingsController@showChangePassword');
        Route::post('/change-password', 'ProfilesSettingsController@updatePassword');

        Route::get('/change-email', 'ProfilesSettingsController@showChangeEmail');
        Route::Post('/change-email', 'ProfilesSettingsController@updateEmail');

        Route::get('/change-username', 'ProfilesSettingsController@showChangeUsername');
        Route::post('/change-username', 'ProfilesSettingsController@updateUsername');

        Route::get('/delete-account', 'ProfilesSettingsController@showDeleteAccount');
        Route::delete('/delete-account', 'ProfilesSettingsController@destroy');
    });

    Route::post('/picture/{username}', 'ProfilesController@update_avatar');

    Route::post('/{username}/subscriptions', 'ProfilesSubscriptionController@store');
});

Route::get('/users', 'ProfilesController@index');
Route::get('/users/{charFilter}', 'ProfilesController@charFilter');


// Route::get('/', 'ProfilesController@getRoles');

//search bar functions?
// Route::get('/', 'SearchController@search');



