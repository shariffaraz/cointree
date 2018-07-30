<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use GeneralFunctions;
use Illuminate\Http\Request;
use Validator;
use View;

class ContactUsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     *
     * Function for Signup Screen
     *
     */
    public function contact_us_screen(Request $req)
    {
        return view('website_content.contact_us');
    }

    /**
     *
     * Function for Validation of form in the Contact Us Screen
     *
     */
    public function validate_contact_us_form(Request $req)
    {
        $rules = [
            'email'       => 'required|email',
            'subject'     => 'required',
            'description' => 'required',
        ];
        $validation_messages = [
            'email.required'       => 'Email address is required',
            'email.email'          => 'Please provide valid email address',
            'description.required' => 'Please provide Desciption for contact',
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
     * Function for sending contact us details
     *
     */
    public function send_contact_details(Request $req)
    {
        // 1) Send Account Registration Confirmation to Super Admin
        $data = [
            'subject'         => 'Contact Us',
            'heading_details' => 'New details by <u><b>' . $req->email . '</b></u>.',
            'sub_heading'     => 'Details In',
            'heading'         => 'Contact Details',
            'title'           => '',
            'content'         => '<h5>Email = ' . $req->email . '</h5><br><h5>Subject = ' . $req->subject . '</h5><br><h5>Subject = ' . $req->description . '</h5>',
            'email'           => 'formanite.yaqoob92@gmail.com',
        ];
        GeneralFunctions::sendEmail($data);
        return back()->with('success', 'Your info has sent to administration. Will contact you through email that you provided.');
    }

}
