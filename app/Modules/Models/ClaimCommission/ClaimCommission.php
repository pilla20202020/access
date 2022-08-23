<?php

namespace App\Modules\Models\ClaimCommission;

use App\Modules\Models\Commission\Commission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimCommission extends Model
{
    use HasFactory;

    protected $table = 'tbl_claim_commissions';

    protected $fillable = [
        'client_name',
        'commission_id',
        'commission_claim_date',
        'claim_remarks',
        'commissions_claim_status',
        'remarks',
        'status',
        'created_by',
        'last_updated_by'
    ];

    public function commission(){
        return $this->belongsTo(Commission::class,'commission_id','commissions_id');
    }
}
