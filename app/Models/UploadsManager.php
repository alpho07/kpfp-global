<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadsManager extends Model
{
    use SoftDeletes;

    use HasFactory;


    protected $fillable = ['file_name', 'slug','required','file_size','file_type'];

    protected $dates = ['deleted_at'];

}
