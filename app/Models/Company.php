<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'bailey_company';
    protected $fillable = [
        'slug',
        'name',
        'symbol',
        'active',
        'sorting',
        'created_by',
        'updated_by'
    ];
    // public function company()  {
    //     return $this->belongsTo(Categorie::class, 'parent_id');
    // }
}
