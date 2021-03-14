<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    /*****************************************************************************
     *
     * Function: LoginController.view().
     * Purpose: Displays a view that contains a form that will allow the user
     *          to log in to their account.
     * Precondition: An auth.login view is established.
     * Postcondition: N/A.
     *
     * @returns view View containing login form.
     *
     ****************************************************************************/
    public function view() {
        return view('auth.login');
    }
}
