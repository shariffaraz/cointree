<?php

namespace App\Http\Controllers\MemberControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;

class StaticContentController extends Controller
{
    /*============================================================================
    =            Section for the Static Content Controller Functionalities            =
    ============================================================================*/
    /**
     *
     * Function for showing How to buy Bitcoin Network
     *
     */

    public function how_to_buy_bitcoin(Request $req)
    {
        return view('members_portal_pages.how_to_buy_bitcoin');
    }

    /**
     *
     * Function for Showing FAQ Page
     *
     */
    public function faq(Request $req)
    {
        return view('members_portal_pages.faq');
    }

    /*=====  End of Section for the Static Content Controller Functionalities  ======*/

}
