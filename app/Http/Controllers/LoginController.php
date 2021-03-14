<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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

    /*****************************************************************************
     *
     * Function: LoginController.loginUser().
     * Purpose: Authenticates a user using information they gave through the login
     *          form.
     * Precondition: N/A.
     * Postcondition: The user's session is authenticated if valid, redirected with
     *                errors if not..
     *
     * @param Request $request The total http request.
     *
     ****************************************************************************/
    public function loginUser(Request $request) {
        $credentials = $request->only(['email', 'password']);

        $user = User::firstWhere(['email' => $credentials['email']]);

        if (isset($user)) {
            if (Hash::check($credentials['password'], $user->password)) {
                Auth::login($user);
                $request->session()->regenerate();

                return redirect()->intended('/');
            } else {
                return back()->withErrors(['The password entered is incorrect.']);
            }
        } else {
            return back()->withErrors(['This email is not associated with an account.']);
        }
    }
}
