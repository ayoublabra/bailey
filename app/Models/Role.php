<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'bailey_auth_assignment';

    protected $fillable = [
        'item_name',
        'user_id',
        'created_at',
    ];
}
