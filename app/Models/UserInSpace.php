<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInSpace extends Model
{
    use HasFactory;

    protected $table = 'user_in_spaces';

    protected $fillable = [
        'user_id',
        'space_id',
        'is_owner'
    ];
}
