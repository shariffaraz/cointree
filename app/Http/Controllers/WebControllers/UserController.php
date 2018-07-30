<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /*=========================================================
    =            Section for User Level Controller            =
    =========================================================*/
    /**
     *
     * Function for Signup Screen
     *
     */
    public function signup_screen(Request $req)
    {
        return view('website_content.sginup_screen');
    }

    /**
     *
     * Function for Sponsar Username
     *
     */
    public function validate_sponsar_form(Request $req)
    {
        $rules = [
            'sponsar_username' => 'required',
        ];
        $validation_messages = [
            'sponsar_username.required' => 'Sponsar Username is required',
        ];
        $validator = Validator::make($req->all(), $rules, $validation_messages);

        if ($validator->fails()) {
            $errors = GeneralFunctions::error_msg_serialize($validator->errors());
            return response()->json(['status' => 'error', 'msg_data' => $errors]);
        }
        return response()->json(['status' => 'success']);
    }

    /*=====  End of Section for User Level Controller  ======*/

}
