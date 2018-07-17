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

Route::group(['middleware' => ['localization']], function () {
    /**
     *
     * Localization (Translation of whole Application)
     *
     */
    Route::get('/change/language/{locale}', function ($locale) {
        Session::put('locale', $locale);
        App::setLocale($locale);
        return back();
    });
    /*=======================================================
    =            Section for the Website Content            =
    =======================================================*/
    Route::get('/', function () {
        return view('website_content.home');
    });
    Route::get('/login', 'WebControllers\UserController@login_screen');
    Route::get('/register', 'WebControllers\UserController@register_screen');
    Route::post('register/user', 'WebControllers\UserController@register_user');
    Route::post('login/user', 'WebControllers\UserController@login_user');
    Route::get('/password/reset', 'WebControllers\UserController@reset_password');
    /*=====  End of Section for the Website Content  ======*/
    /**
     *
     * Block for Super Admin Routes
     *
     */
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/login', 'AdminControllers\UserController@login_screen');
        Route::group(['middleware' => ['super_admin']], function () {
            Route::group(['middlewareGroups' => ['web']], function () {
                /**

                TODO:
                - Creating Dashboard Controlling
                - Pcakge Control Controlling

                 */

                /*----------- Subsection For the Admin Routes -----------*/
            });
        });
    });

    /**
     *
     * Block for Members Authenticated Routes
     *
     */
    Route::group(['prefix' => 'users'], function () {
        Route::group(['middleware' => ['members']], function () {
            Route::group(['middlewareGroups' => ['web']], function () {
                /**

                TODO:
                - Creating Dashboard Controlling
                - Pcakge Control Controlling

                 */
                /*----------  Subsection For the User Routes  ----------*/

            });
        });
    });
});
