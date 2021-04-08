<?php

namespace App\Policies;

use App\Models\Particle;
use App\Models\Space;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ParticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param Particle $particle
     * @return mixed
     */
    public function view(User $user, Particle $particle)
    {
        //
    }

    /***************************************************************************************************
     *
     * Determine whether the user can create models.
     *
     * @param User|null $user
     * @return mixed
     *
     *************************************************************************************************/
    public function create(User $user = null) {
        return !is_null($user) && $user->spaces->contains(function(Space $userSpace) {
            return $userSpace->id == request()->space;
        })
            ? Response::allow()
            : Response::deny('You have not joined this space, or are not yet logged in.');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Particle $particle
     * @return mixed
     */
    public function update(User $user, Particle $particle)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Particle $particle
     * @return mixed
     */
    public function delete(User $user, Particle $particle)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Particle $particle
     * @return mixed
     */
    public function restore(User $user, Particle $particle)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Particle $particle
     * @return mixed
     */
    public function forceDelete(User $user, Particle $particle)
    {
        //
    }
}
