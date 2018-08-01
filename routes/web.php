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
    /*----------  Login route  ----------*/
    Route::get('/login', 'WebControllers\UserController@login_screen');
    /*----------  Sign up route  ----------*/
    Route::get('/sign_up', 'WebControllers\UserController@signup_screen');
    Route::post('/sponsar/needed/validate/info', 'WebControllers\UserController@validate_sponsar_form');
    /*----------  Contactus route  ----------*/
    Route::get('/contact_us', 'WebControllers\ContactUsController@contact_us_screen');
    Route::post('/contact_us/validate/info', 'WebControllers\ContactUsController@validate_contact_us_form');
    Route::post('send/contact_us/details', 'WebControllers\ContactUsController@send_contact_details');

    Route::get('/register', 'WebControllers\UserController@register_screen');
    Route::post('register/user', 'WebControllers\UserController@register_user');
    Route::post('login/user', 'WebControllers\UserController@login_user');
    Route::get('/password/reset', 'WebControllers\UserController@reset_password');
    /*----------  About us Route  ----------*/
    Route::get('/about_us', 'WebControllers\AboutUsController@about_screen');

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
