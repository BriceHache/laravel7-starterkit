<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('/checkLogin', 'DataController@checkLogin');



Route::pattern('slug', '[a-z0-9- _]+');

Route::group(
    ['prefix' => 'admin', 'namespace' => 'Admin'],
    function () {

        // Error pages should be shown without requiring login
        Route::get('404', 'DataController@page404')->name('page404');
        Route::get('500', 'DataController@page500')->name('page500');


        // All basic authentication routes defined here
        Route::get('login', 'AuthController@getSignin')->name('login');
        Route::get('signin', 'AuthController@getSignin')->name('signin');
        Route::post('signin', 'AuthController@postSignin')->name('postSignin');
        Route::post('signup', 'AuthController@postSignup')->name('admin.signup');
        Route::post('forgot-password', 'AuthController@postForgotPassword')->name('forgot-password');
        Route::post('register2', 'AuthController@postRegister2')->name('register2');

        // Logout
        Route::get('logout', 'AuthController@getLogout')->name('logout');

        // Account Activation
        Route::get('activate/{userId}/{activationCode}', 'AuthController@getActivate')->name('activate');

    }
);

Route::group(
    ['prefix' => 'admin', 'middleware' => 'admin','namespace' => 'Admin', 'as' => 'admin.'],
    function () {

        //dashboard
        Route::get('/', 'DataController@index')->name('dashboard');


        //template settings
        Route::get('/template_settings', 'DataController@template_settings')->name('template_settings.index');
        Route::post('/template_settings', 'DataController@save_template_settings')->name('save_template_settings.index');

        // User Management
        Route::group(
            ['prefix' => 'users'],
            function () {
                Route::get('data', 'UsersController@data')->name('users.data');
                Route::get('{user}/delete', 'UsersController@destroy')->name('users.delete');
                Route::get('{user}/confirm-delete', 'UsersController@getModalDelete')->name('users.confirm-delete');
                Route::get('{user}/restore', 'UsersController@getRestore')->name('restore.user');
                //        Route::post('{user}/passwordreset', 'UsersController@passwordreset')->name('passwordreset');
                Route::post('passwordreset', 'UsersController@passwordreset')->name('passwordreset');
            }
        );
        Route::resource('users', 'UsersController');
        /************
         * bulk import
         ****************************/
        Route::get('bulk_import_users', 'UsersController@import');
        Route::post('bulk_import_users', 'UsersController@importInsert');
        /****************
        bulk download
         **************************/
        Route::get('download_users/{type}', 'UsersController@downloadExcel');

        /************
         * Delete users
         ***********/
        Route::get('deleted_users', ['before' => 'Sentinel', 'uses' => 'UsersController@getDeletedUsers'])->name('deleted_users');

    }
);


