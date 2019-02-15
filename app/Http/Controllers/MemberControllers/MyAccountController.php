<?php

namespace App\Http\Controllers\MemberControllers;

use App\ContactDetails;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use GeneralFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use View;

class MyAccountController extends Controller
{
    /*============================================================================
    =            Section for the MyAccount Controller Functionalities            =
    ============================================================================*/
    /**
     *
     * Function for showing my account Screen
     *
     */

    public function home_page(Request $req)
    {
        $getUserDetails       = User::with('contact_details')->where('id', Auth::user()->id)->first();
        $data['user_details'] = $getUserDetails->toArray();
        return view('members_portal_pages.myaccount', $data);
    }

    /**
     *
     * Function for Updating account details
     *
     */
    public function update_account_details(Request $req)
    {
        // 1) Update Record in User Table
        $memberRecord = [
            'Username'     => $req->user_name,
            'EmailAddress' => $req->user_email,
        ];

        // 2) Update Record in Contact Details Table
        $contactDetails = [
            'first_name'   => $req->first_name,
            'last_name'    => $req->last_name,
            'phone_number' => $req->phone_number,
            'fb_url'       => $req->fb_page,
            'tw_url'       => $req->tw_page,
            'skype_usr'    => $req->skype_usr,
            'name'         => $req->first_name . ' ' . $req->last_name,
        ];
        $contactDetails = ContactDetails::where('user_id', Auth::user()->id)->update($contactDetails);

        // 3) Update Password if required (Optional)
        if ($req->old_password != null && $req->password != null && $req->password_confirmation != null) {
            $memberRecord['password'] = Hash::make($req->password);
        }
        $userDetails = User::where('id', Auth::user()->id)->update($memberRecord);
        return back()->with('success', 'Successfully updated the record');
    }
    /**
     *
     * Function for myaccount form validation using ajax request
     *
     */
    public function account_form_validation(Request $req)
    {
        $rules = [
            'first_name' => 'required|max:20',
            'last_name'  => 'required|max:20',
            'user_name'  => 'required|min:7',
            'user_email' => 'required|email|unique:users,EmailAddress,' . Auth::user()->id,
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
            'password.different'             => 'Password should be different from old password',
            'password_confirmation.required' => 'Password Verify field is required',
            'password_confirmation.min'      => 'Password Verify should be minimum 8 character long',
            'old_password.required'          => 'Old Password is required',
            'old_password.pwdvalidation'     => 'Old Password is incorrect',
            'user_email.unique'              => 'Email Address already exist in system. Please try with other email',
        ];
        if ($req->old_password != null || $req->password != null || $req->password_confirmation != null) {
            $rules['password']              = 'required|confirmed|min:8|different:old_password';
            $rules['password_confirmation'] = 'required|min:8';
            $rules['old_password']          = 'required|pwdvalidation';
        }
        Validator::extend('pwdvalidation', function ($attribute, $value, $parameters) {
            return Hash::check($value, Auth::user()->password);
        });
        $validator = Validator::make($req->all(), $rules, $validation_messages);

        if ($validator->fails()) {
            $errors = GeneralFunctions::error_msg_serialize($validator->errors());
            return response()->json(['status' => 'error', 'msg_data' => $errors]);
        }
        return response()->json(['status' => 'success']);
    }
    /*=====  End of Section for the Dashboard Controller Functionalities  ======*/

}
