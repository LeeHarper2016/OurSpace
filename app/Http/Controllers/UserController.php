<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{

    /********************************************************************
     *
     * Function: UserController.edit()
     * Purpose: Displays to the user a form that allows them to edit
     *          account details.
     * Precondition: The user is currently authenticated.
     * Posctondition: N/A.
     *
     * @return View The form that the user can use to edit account details.
     *
     *******************************************************************/
    public function edit() {
        $user = auth()->user();

        if (isset($user)) {
            return view('user.edit')->with(['user' => $user]);
        } else {
            return back()->withErrors(['You are not currently logged in.w']);
        }
    }
}
