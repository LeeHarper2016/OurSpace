<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*************************************************************
     *
     * Function: RegisterController.view().
     * Purpose: Displays a view containing a registration form to
     *          to the user.
     * Precondition: There is a valid register.blade.php file to
     *               display.
     * Postcondition: N/A.
     *
     * @returns view View containing registration form.
     *
     ************************************************************/
    public function view() {
        return view('auth.register');
    }
}
