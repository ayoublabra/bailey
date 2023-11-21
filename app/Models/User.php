<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Facades\DB;
use App\Models\OperateurAcces;

use App\Models\Operator;
use App\Models\RoleUser;



class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasFactory, Notifiable, HasRoles, InteractsWithMedia;
    
    protected $table = 'bailey_user';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'username',
        'email',
        'status',
        'password_hash',
        'auth_key',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
        'password_hash',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['full_name'];

    public function role_users() {
        return $this->hasMany(RoleUser::class,'user_id','id');
    }

    public function operator_access() {
        return $this->hasMany(OperateurAcces::class,'user_id','id');
    }
    public function operators() {
        return $this->hasMany(Operator::class,'user_id','id');
    }
    public function getAuthPassword()
    {
        return $this->password_hash; // case sensitive
    }
    function getRoleForUser($id) {
        $roles  = DB::table('bailey_role')
                                        ->join('bailey_role_user', 'bailey_role_user.role_id', '=', 'bailey_role.id')
                                        ->where('bailey_role_user.user_id', '=', $id)
                                        ->get();
                
                                        $item = $roles->first();
    
                                        // Vérifiez si l'élément est présent et n'est pas nul
                                        if ($item) {
                                            return $item->nomRole;
                                        }
    
    }
    function getTypeContrat($id){
    
        $companysForUser = DB::table('bailey_company')
    
        ->select('name')
    
         ->join('bailey_operator_access', 'bailey_operator_access.company_id', '=', 'bailey_company.id')
    
         ->where('bailey_operator_access.user_id', '=', $id) ->get();
    
         $roles  = DB::table('bailey_role')
    
                                        ->join('bailey_role_user', 'bailey_role_user.role_id', '=', 'bailey_role.id')
    
                                        ->where('bailey_role_user.user_id', '=', $id)
    
                                        ->get();
    
                                        $item = $roles->first();
    
     
    
        $exit=false;
    
        if ($item) {
    
            if ($item->nomRole=='superadmin') {
    
                echo 'gére tous les types de contrats';
    
            }elseif($item->nomRole=='agent'){
    
                echo 'Aucune type de contrat';
    
            }
    
        }
    
        if (count($companysForUser)!=0) {
    
            $exit=true;
    
            $data = json_decode($companysForUser, true);
    
     
    
            $names = array();
    
     
    
            foreach ($data as $item) {
    
                $names[] = $item['name'];
    
            }
    
     
    
            foreach ($names as $name) {
    
                echo $name ."  ". "\n";
    
            }
    
        }
    
         
    
     
    
     
    
    }
}
