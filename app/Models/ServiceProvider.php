<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $table = 'bailey_service_provider';

    protected $fillable = [
        'id',
        'company_id',
        'name',
        'type',
        'active',
        'created_by',
        'updated_by',
    ];
}
