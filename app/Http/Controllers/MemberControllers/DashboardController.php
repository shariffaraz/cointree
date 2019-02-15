<?php

namespace App\Http\Controllers\MemberControllers;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use GeneralFunctions;
use Illuminate\Http\Request;
use Validator;
use View;

class DashboardController extends Controller
{
    /*============================================================================
    =            Section for the Dashboard Controller Functionalities            =
    ============================================================================*/

    public function home_page(Request $req)
    {
        return view('members_portal_pages.dashboard');
    }

    /**
     *
     * Function for Validation of verify code
     *
     */
    public function verify_code_validation(Request $req)
    {
        $rules = [
            'verification_code' => 'required',
        ];
        $validation_messages = [
            'verification_code.required' => 'Verification Code is required',
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
     * Function for verifying Code
     *
     */
    public function verify_code(Request $req)
    {
        $verifyEmailAddress = User::where('id', Auth::user()->id)->where('varification_code', $req->verification_code)->where('EmailAddress', Auth::user()->EmailAddress)->get()->toArray();
        if (count($verifyEmailAddress) > 0) {
            // Change the Verification status of the Account and make account verifiable.
            $updateMemberAccount = User::where('id', Auth::user()->id)->update(['varification_status' => 1]);
            return back()->with('success', 'Congratulations, you have Verified Email address. You can now use the services of the account.');
        }
        return back()->with('error_msg', 'Sorry, please try again. Code does not match');
    }
    /*=====  End of Section for the Dashboard Controller Functionalities  ======*/
}
