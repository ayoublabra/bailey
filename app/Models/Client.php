<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'bailey_client';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'iban',
        'bank_id ',
        'date_of_birth',
        'last_name',
        'civility',
        'first_name'
    ];
}
