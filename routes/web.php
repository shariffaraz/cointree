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
    Route::post('/send/sponsar_details', 'WebControllers\UserController@check_sponsarship');
    Route::get('/membership_details_form/{id}', 'WebControllers\UserController@membership_details_form');
    Route::post('/membership/validate/info', 'WebControllers\UserController@validate_membership_form');
    Route::post('/save/membership_details', 'WebControllers\UserController@save_membership_details');
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
    /*----------  Logout Route  ----------*/
    Route::get('/logout', 'WebControllers\UserController@logout');
    /*----------  Members Login Routes  ----------*/
    Route::get('/member/login', 'WebControllers\UserController@login_screen');
    Route::post('/members/login/validate/info', 'WebControllers\UserController@validate_member_login_form');
    Route::post('/member/authentication', 'WebControllers\UserController@member_login');
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
                /*----------  Subsection For the Dashboard Routes.  ----------*/
                Route::get('/dashboard', 'MemberControllers\DashboardController@home_page')->name('dashboard');
                Route::post('/verify_code/validate/info', 'MemberControllers\DashboardController@verify_code_validation');
                Route::post('/verify/email_address', 'MemberControllers\DashboardController@verify_code');
                /*----------  Subsection For the MyAccount Routes  ----------*/
                Route::get('/my_account', 'MemberControllers\MyAccountController@home_page')->name('my_account');
                Route::post('/user_details/validate/info', 'MemberControllers\MyAccountController@account_form_validation');
                Route::post('/user_details/update/record', 'MemberControllers\MyAccountController@update_account_details');
                /*----------  Subsection For the How to Buy Bitcoin Routes  ----------*/
                Route::get('/how_to_buy_bitcoin', 'MemberControllers\StaticContentController@how_to_buy_bitcoin')->name('how_to_buy_bitcoin');
                /*----------  Subsection For the FAQ Routes  ----------*/
                Route::get('/faq', 'MemberControllers\StaticContentController@faq')->name('faq');
                /*----------  Subsection For Upgrade Account Routes  ----------*/
                Route::get('/upgrade_my_account', 'MemberControllers\UpgradeAccountController@home_page');
            });
        });
    });
});
