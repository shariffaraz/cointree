<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;

class OpportunityController extends Controller
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
     * Function for About Us Screen
     *
     */
    public function index(Request $req)
    {
        return view('website_content.opportunity');
    }

}
