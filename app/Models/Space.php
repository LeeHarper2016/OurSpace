<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon_picture_path',
        'banner_picture_path'
    ];

    /********************************************************************
     *
     * Function: Space.users()
     * Purpose: Retrieve a collection of all users that are in the space.
     * Precondition: N/A.
     * Posctondition: N/A.
     *
     * @return BelongsToMany The collection of users in the space.
     *
     *******************************************************************/
    public function users() {
        return $this->belongsToMany(User::class, 'user_in_spaces')
            ->withTimestamps();
    }
}
