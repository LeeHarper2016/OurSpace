<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    /********************************************************************
     *
     * Function: UserController.update()
     * Purpose: Updates the user's account using information given by the
     *          user.
     * Precondition: The user is currently authenticated.
     * Posctondition: The user's account information is updated.
     * TODO: Implement functionality for changing user icon.
     *
     * @param Request $request The whole http request.
     * @return View Redirection back to the homepage.
     *
     ******************************************************************/
    public function update(Request $request) {
        $user = auth()->user();

        if (isset($user)) {
            $validatedDate = $request->validate([
                'name' => 'required',
                'email' => 'required'
            ]);

            $user->fill($validatedDate)
                ->save();

            return redirect('/')->with(['status' => 'Success']);
        } else {
            return redirect('/')->withErrors('You are not currently logged in.');
        }
    }
}
