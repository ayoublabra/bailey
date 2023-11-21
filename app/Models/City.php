<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'bailey_city';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'region_id',
        'name',
        'type',
        'active',
        'sorting',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
    // protected $fillable2 = [
    //     'id',
    //     'code_commune_insee',
    //     'name_municipalitie_postal ',
    //     'postal_code',
    //     'municipalitie_name',
    //     'code_department',
    //     'department_name',
    //     'code_region',
    //     'region_name',
    //     'active',
    //     'sorting',
    // ];

}
