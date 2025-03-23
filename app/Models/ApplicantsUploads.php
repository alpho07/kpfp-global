<?php
namespace App\Models;

use App\Traits\BelongsToInstitution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantsUploads extends BaseModel
{
    use HasFactory;
    use BelongsToInstitution;

    protected $fillable = ['student_id', 'document_id', 'file_path','version','course_id','institution_id'];

    public function student()
    {
        return $this->belongsTo(User::class,'student_id','id');
    }

    public function document()
    {
        return $this->belongsTo(UploadsManager::class,'document_id','id');
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class,'institution_id','id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }
}
