<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleFinal extends Model
{
    use HasFactory;

    protected $table = 'bailey_role';

    protected $fillable = [
        'id',
        'nomRole',
        'description'
    ];
}
