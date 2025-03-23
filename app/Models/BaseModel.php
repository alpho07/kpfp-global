<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AssignsInstitution;
use App\Traits\BelongsToInstitution;

class BaseModel extends Model
{
    use BelongsToInstitution, AssignsInstitution;

    // You can also add common functionality here, like timestamps or soft deletes, etc.

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
