<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
     * @param RegisterRequest $request Request containing the
     *        validated registration data from the form..
     * @return RedirectResponse Redirection to the homepage.
     *
    *************************************************************/
    public function registerUser(RegisterRequest $request) {
        $validateData = $request->validated();

        $user = new User;

        $user->fill([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
        ]);

        $user->save();

        return redirect('/')->with(['status' => 'Registration successful!']);
    }
}
