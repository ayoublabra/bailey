<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;

    protected $table = 'bailey_operator';
	    public $timestamps = false;


    protected $fillable = [
        'id',
        'status_id',
        'last_name',
        'first_name',
        'date_of_creation',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'user_id',
        'phone',
    ];
}
