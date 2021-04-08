<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticleRequest;

use App\Models\Particle;
use App\Models\Space;
use Exception;

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
     * @param ParticleRequest $request The whole http request.
     * @throws Exception
     * @return mixed Redirection back to the original page.
     *
     *************************************************************************/
    public function store(int $spaceId, ParticleRequest $request) {
        $validatedData = $request->validated();

        $particle = new Particle;
        $particle->fill([
            'user_id' => auth()->user()->id,
            'space_id' => $spaceId,
            'body' => $validatedData['body']
        ]);

        $particle->save();

        return response('')->setStatusCode(201);
    }
}
