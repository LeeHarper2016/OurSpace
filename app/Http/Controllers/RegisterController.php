<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    /*************************************************************
     *
     * Function Name: RegisterController.registerUser()
     * Purpose: Registers a new user to the database.
     * Precondition: N/A.
     * Postcondition: A new user is added to the database.
     *
     * @param Request $request The total http request.
     * @return RedirectResponse Redirection to the homepage.
     *
    *************************************************************/
    public function registerUser(Request $request) {
        if ($request->password !== $request->passwordCheck) {
            return redirect('/register')
                ->withErrors('The password combination entered was incorrect. Please try again');
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);

            auth()->user()
                ->fill([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ])
                ->save();

            return redirect('/')->with(['status' => 'Registration successful!']);
        }
    }
}
