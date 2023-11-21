<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $table = 'bailey_company_to_day';

    protected $fillable = [
        'company_id',
        'day_id',
    ];
}
