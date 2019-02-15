<?php

namespace App\Http\Controllers\WebControllers;

use App\ContactDetails;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use GeneralFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Redirect;
use Validator;
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

    /**
     *
     * Function for checking sponsarship account details
     *
     */
    public function check_sponsarship(Request $req)
    {
        // 1) Check Sponsar from the User Detail Table
        $checkSponsarAvailability = User::where('Username', $req->sponsar_username)->get()->toArray();
        if (count($checkSponsarAvailability) > 0) {
            $data['sponsar_details'] = $checkSponsarAvailability;
            return redirect('/membership_details_form/' . $data['sponsar_details'][0]['id']);
        }
        // return redirect('/membership_details_form/0');
        return back()->with('error_msg', 'We did not found any record for this sponsar. Please check the username. Thanks');
    }

    /**
     *
     * Function for Membership Details form
     *
     */
    public function membership_details_form($sponsar_id)
    {
        $data['sponsar_details'] = null;
        if ($sponsar_id == 0) {
            return view('website_content.sponsar_signup_detail_screen');
        }
        // Send Sponsar Details
        $data['sponsar_details'] = User::where('id', $sponsar_id)->first();
        return view('website_content.sponsar_signup_detail_screen', $data);
    }

    /**
     *
     * Function for Validation of Membership using Ajax Request
     *
     */
    public function validate_membership_form(Request $req)
    {

        $rules = [
            'first_name'            => 'required|max:20',
            'last_name'             => 'required|max:20',
            'user_name'             => 'required|min:7',
            'user_email'            => 'required|email',
            'password'              => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
        ];
        $validation_messages = [
            'first_name.required'            => 'First Name is required',
            'first_name.max'                 => 'First Name should not exceed more than 20 characters',
            'last_name.required'             => 'Last Name is required',
            'last_name.max'                  => 'Last Name should not exceed more than 20 characters',
            'user_name.required'             => 'Username is required',
            'user_name.min'                  => 'Username should be minimum 7 character long',
            'password.required'              => 'Password is required',
            'password.confirmed'             => 'Password does not match with Re type password field',
            'password.min'                   => 'Password should be minimum 7 character long',
            'password_confirmation.required' => 'Password Re Type field is required',
            'password_confirmation.min'      => 'Password Re Type should be minimum 8 character long',
        ];
        $validator = Validator::make($req->all(), $rules, $validation_messages);

        if ($validator->fails()) {
            $errors = GeneralFunctions::error_msg_serialize($validator->errors());
            return response()->json(['status' => 'error', 'msg_data' => $errors]);
        }
        return response()->json(['status' => 'success']);
    }

    /**
     *
     * Function for Registration (Membership Input)
     *
     */
    public function save_membership_details(Request $req)
    {
        $varification_code = GeneralFunctions::generateVarificationCode();
        // 1) Save Recor in User (Members Table)
        $userRecord = [
            'EmailAddress'      => $req->user_email,
            'password'          => Hash::make($req->password),
            'Username'          => $req->user_name,
            'varification_code' => $varification_code,
            'Roles'             => 2,
            'parent_id'         => $req->sponsar_id,
        ];
        $saveMember = User::create($userRecord);

        // 2) Save in Contact Details Tables
        $contactDetails = [
            'first_name' => $req->first_name,
            'last_name'  => $req->last_name,
            'user_id'    => $saveMember->id,
            'name'       => $req->first_name . ' ' . $req->last_name,
        ];
        $saveContactDetails = ContactDetails::create($contactDetails);
        $data               = [
            'subject'         => 'Please Verify your email.',
            'heading_details' => 'Verification Code',
            'sub_heading'     => 'Details In',
            'heading'         => 'Please Varify your email address',
            'title'           => '',
            'content'         => '<h5>Varification Code = ' . $varification_code,
            'email'           => $req->user_email,
        ];
        GeneralFunctions::sendEmail($data);
        // 3) Check Authentication
        if (Auth::attempt(['username' => $req->user_name, 'password' => $req->input('password')])) {

            $sessionData = [
                'email'     => Auth::user()->email,
                'user_name' => Auth::user()->username,
                'full_name' => $req->first_name . ' ' . $req->last_name,
            ];
            session($sessionData);
            return redirect('/users/dashboard');
        }
    }

    /**
     *
     * Function for logout Authentication
     *
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/member/login');
    }

    /**
     *
     * Function for Login Screen
     *
     */
    public function login_screen(Request $req)
    {
        return view('website_content.login_screen');
    }

    /**
     *
     * Function for Member Login form Validation
     *
     */
    public function validate_member_login_form(Request $req)
    {
        $rules = [
            'user_name' => 'required',
            'password'  => 'required',
        ];
        $validation_messages = [
            'user_name.required' => 'User Name is required',
            'password.required'  => 'Password is required',
        ];
        $validator = Validator::make($req->all(), $rules, $validation_messages);

        if ($validator->fails()) {
            $errors = GeneralFunctions::error_msg_serialize($validator->errors());
            return response()->json(['status' => 'error', 'msg_data' => $errors]);
        }
        return response()->json(['status' => 'success']);
    }

    /**
     *
     * Function for Member Authentication
     *
     */
    public function member_login(Request $req)
    {
        if (Auth::attempt(['Username' => $req->user_name, 'password' => $req->input('password'), 'Roles' => 2])) {
            // $getRecord = User::with('child_users')->where('id', Auth::user()->id)->get()->toArray();

            // dd($getRecord);
            $getMemberInformation = ContactDetails::where('user_id', Auth::user()->id)->first();
            $sessionData          = [
                'email'     => Auth::user()->EmailAddress,
                'user_name' => Auth::user()->Username,
                'full_name' => $getMemberInformation->first_name . ' ' . $getMemberInformation->last_name,
            ];
            session($sessionData);
            return redirect('/users/dashboard');
        }
        return back()->with('error_msg', 'Incorrect Credentials. Please check again');
    }

/*=====  End of Section for User Level Controller  ======*/
}
