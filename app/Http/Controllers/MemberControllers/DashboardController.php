<?php

namespace App\Http\Controllers\MemberControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    /*=====  End of Section for the Dashboard Controller Functionalities  ======*/

}
