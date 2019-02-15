<?php

namespace App\Http\Controllers\MemberControllers;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
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

    /**
     *
     * Function for Showing Members of Current User
     *
     */
    public function show_members(Request $req)
    {
        $getRecord = User::with('children')->with('text')->where('id', Auth::user()->id)->select('Username as name', 'id', 'parent_id')->get()->toArray();
        $data      = [
            'record' => $getRecord,
        ];
        return view('members_portal_pages.members', $data);
    }

    /*=====  End of Section for the Static Content Controller Functionalities  ======*/

}
