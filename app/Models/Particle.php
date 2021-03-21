<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Particle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'space_id',
        'body'
    ];

    /********************************************************************
     *
     * Function: Particle.user()
     * Purpose: Retrieve the user that posted the particle.
     * Precondition: N/A.
     * Posctondition: N/A.
     *
     * @return BelongsTo The user that posted the space.
     *
     *******************************************************************/
    public function user() {
        return $this->belongsTo(User::class);
    }

    /********************************************************************
     *
     * Function: Particle.space()
     * Purpose: Retrieve the space associated with the particle.
     * Precondition: N/A.
     * Posctondition: N/A.
     *
     * @return BelongsTo The space that the particle was posted to.
     *
     *******************************************************************/
    public function space() {
        return $this->belongsTo(Space::class);
    }
}
