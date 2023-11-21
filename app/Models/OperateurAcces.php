<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class OperateurAcces extends Model
{
    use HasFactory;
    protected $table = 'bailey_operator_access';
    protected $fillable = [
        'user_id',
        'company_id',
        'created_at',
        'updated_at'
    ];
    public function company()  {
        return $this->belongsTo(Company::class,'company_id','id');
    }

}

