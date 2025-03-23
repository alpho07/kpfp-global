<?php

namespace App\Models;

use App\Traits\BelongsToInstitution;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModeOfPayment extends BaseModel
{
    use SoftDeletes;
    use BelongsToInstitution;

    public $table = 'mode_of_payments';

    protected $appends = [
        'logo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'institution_id',
        'mobile_name',
        'mobile_number',
        'mobile_paybill',
        'mobile_paybill_no',
        'bank_name',
        'bank_branch',
        'account_name',
        'account_number',
        'amount',
        'created_at',
        'updated_at',
        'deleted_at',

    ];
    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }
}
