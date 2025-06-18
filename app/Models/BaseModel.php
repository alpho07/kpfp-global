<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AssignsInstitution;
use App\Traits\BelongsToInstitution;
use App\Traits\ScholarshipUtil;

class BaseModel extends Model
{
    use BelongsToInstitution, AssignsInstitution, ScholarshipUtil;

    // You can also add common functionality here, like timestamps or soft deletes, etc.

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
