<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Particle extends Model
{
    use HasFactory;



    /********************************************************************
     *
     * Function: Particle.space()
     * Purpose: Retrieve the space associated with the particle.
     * Precondition: N/A.
     * Posctondition: N/A.
     *
     * @return BelongsToMany The space that the particle was posted to.
     *
     *******************************************************************/
    public function space() {
        return $this->belongsTo(Space::class)
            ->withTimestamps();
    }
}
