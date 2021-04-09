<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserInSpace extends Pivot
{
    use HasFactory;

    protected $table = 'user_in_spaces';

    protected $fillable = [
        'user_id',
        'space_id'
    ];
}
