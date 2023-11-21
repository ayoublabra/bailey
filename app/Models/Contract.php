<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $table = 'bailey_contract';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'contract_number',
        'company_id',
        'client_id',
        'iban',
        'bic_swift',
        'operator_id',
        'status',
        'step',
        'date',
        'pdl_number',
        'service_provider_id',
        'landline_phone',
        'mobile_phone',
        'type_of_building',
        'address',
        'postal_code',
        'city_name',
        'city_id',
        'day_id',
        'sage_number',
        'status_updated_at',
        'excel_row',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'state',
        'is_signed',
        'is_saved',
        'signed',
        'signed_date',
        'envelopeId',
        'email',
        'group',
        'data',
        'id_user',
        'departement',
        'commune',
        'pays',
        'nom_naissance'
    ];
    function getId(){
        return $this->id;
    }
}
