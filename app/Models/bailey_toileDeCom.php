<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bailey_toileDeCom extends Model
{
    use HasFactory;

    protected $fillable =[
            'last_name',
            'first_name',
            'civility',
            'address',
            'postal_code',
            'city',
            'email',
            'phone',
            'mobile_phone',
            'iban',
            'bic',
            'type_contract',
            'statut_contract',
            'date_creation',
            'date_signature',
            'date_validation',
    ];
}
