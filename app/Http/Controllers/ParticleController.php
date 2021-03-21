<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

use App\Models\Particle;
use Illuminate\Http\Request;

class ParticleController extends Controller
{
    /**************************************************************************
     *
     * Function: ParticleController.store().
     * Purpose: Stores a new particle to the database.
     * Precondition: The data entered is valid and the user is authenticated.
     * Postcondition: The particle is added to the database.
     *
     * @param int $spaceId The ID of the current space
     * @param Request $request The whole http request.
     * @return RedirectResponse Redirection back to the original page.
     *
     ************************************************************************/
    public function store(int $spaceId, Request $request) {
        $validatedData = $request->validate([
            'body' => ['required', 'text']
        ]);

        $particle = new Particle;
        $particle->fill([
            'user_id' => auth()->user()->id,
            'space_id' => $spaceId,
            'body' => $validatedData['body']
        ]);

        $particle->save();

        return back();
    }
}
