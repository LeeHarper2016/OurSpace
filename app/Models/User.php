<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /********************************************************************
     *
     * Function: User.spaces()
     * Purpose: Retrieve a collection of all spaces that the user is in.
     * Precondition: N/A.
     * Posctondition: N/A.
     *
     * @return BelongsToMany The collection of spaces the user is in.
     *
     *******************************************************************/
    public function spaces() {
        return $this->belongsToMany(Space::class, 'user_in_spaces')
            ->withTimestamps();
    }


    /********************************************************************
     *
     * Function: User.spaces()
     * Purpose: Encrypts the password before it is entered into the database.
     * Precondition: N/A.
     * Posctondition: N/A.
     *
     * @param string $password
     *
     *******************************************************************/
    public function setPasswordAttribute(string $password) {
        $this->attributes['password'] = Hash::make($password);
    }
}
