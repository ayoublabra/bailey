<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class RoleUser extends Model
{
    use HasFactory;

    protected $table = 'bailey_role_user';
   

    protected $fillable = [
        'role_id',
        'user_id',
        'created_at',
        'updated_at'
    ];
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function role() {
        return $this->belongsTo(RoleFinal::class,'role_id','id');
    }
}
