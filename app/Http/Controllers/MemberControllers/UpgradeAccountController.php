<?php

namespace App\Http\Controllers\MemberControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;

class UpgradeAccountController extends Controller
{
    /*============================================================================
    =            Section for the Upgrade Account Controller Functionalities            =
    ============================================================================*/
    /**
     *
     * Function for showing Upgrade Account Page
     *
     */

    public function home_page(Request $req)
    {
        return view('members_portal_pages.upgrade_my_account');
    }

    /*=====  End of Section for the Upgrade Account Controller Functionalities  ======*/

}
