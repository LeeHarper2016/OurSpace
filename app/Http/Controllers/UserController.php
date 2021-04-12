<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ImageService;
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
        $avatarFilePath = 'images/avatar_images/';

        if (isset($user)) {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => ['required', 'unique:App\Models\User,email,' . $user->id],
                'avatar' => ['image', 'max:100000'],
            ]);

            if (isset($validatedData['avatar'])) {
                $validatedData['avatar'] = ImageService::uploadImage($validatedData['avatar'], $avatarFilePath);
            }

            $user->fill($validatedData)
                ->save();

            return redirect('/')->with(['status' => 'Success']);
        } else {
            return back()->withErrors('You are not currently logged in.');
        }
    }
}
