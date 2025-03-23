<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ChecklistStudent extends Model
{
    use HasFactory;

    protected $table = 'checklists';



    protected $fillable = [
        'scholarship_id',
        'application_id',
        'aof_govt',
        'aof_ea',
        'commitment',
        'not_beneficiary',
        'completed_application',
        'personal_statement',
        'cv',
        'certs',
        'national_id',
        'institution_id'
    ];

    public function application(): HasOne
    {
        return $this->hasOne(Applications::class, 'checklist', 'id');
    }

    public function academicHistory(): HasMany
    {
        return $this->hasMany(AcademicHistory::class,  'checklist', 'id');
    }

    public function qualificationAttained(): HasMany
    {
        return $this->hasMany(QualificationAttained::class,  'checklist', 'id');
    }

    public function professionalReference(): HasMany
    {
        return $this->hasMany(ProfessionalReference::class,  'checklist', 'id');
    }

    public function employment(): HasMany
    {
        return $this->hasMany(Employment::class,  'checklist', 'id');
    }

    public function disclaimer(): HasOne
    {
        return $this->hasOne(Disclaimer::class,  'checklist', 'id');
    }








    public static function uploadAndSaveFile($fileField, UploadedFile $file, $id, $combined, $type)
    {
        // Generate a sanitized file name (without encrypting it)
        $fileName = $combined . '_' . date('Y_m_d') . '_' . $type . '_' . self::sanitizeInput($file->getClientOriginalName());

        // Define the folder path where the file should be stored
        $folder = 'files/personal_documents/' . $combined . '_' . self::sanitizeInput(auth()->user()->name);

        // Ensure the folder exists
        Storage::disk('public')->makeDirectory($folder);

        // Full file path for saving in the database
        $filePath = $folder . '/' . $fileName;

        // Check if a file with the same name exists and delete it before saving a new one
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // Store the file in the correct directory within public storage
        $file->storeAs($folder, $fileName, 'public');

        // Save the file path in the database
        self::find($id)->update([
            $fileField => $filePath,
        ]);

        return $fileName;
    }
    
    public static function sanitizeInput($input)
    {
        // Remove HTML tags and encode special characters
        $sanitizedInput = filter_var($input, FILTER_SANITIZE_STRING);

        // Replace special characters with underscores
        $sanitizedInput = str_replace([' ', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '+', '=', '{', '}', '[', ']', '|', ';', ':', ',',  '<', '>', '?', '/', '\\', "'", '"', '`', '~'], '_', $sanitizedInput);

        // Remove consecutive underscores
        $sanitizedInput = preg_replace('/_+/', '_', $sanitizedInput);

        // Trim underscores from the beginning and end
        $sanitizedInput = trim($sanitizedInput, '_');

        return $sanitizedInput;
    }

    public static function  createFolderInPublic($folderPath)
    {
        // Check if the folder exists
        if (!Storage::disk('public')->exists($folderPath)) {
            // Create the folder
            //Storage::makeDirectory($folderPath);
            Storage::disk('public')->makeDirectory($folderPath);

            echo "Folder created successfully: $folderPath";
        } else {
            echo "Folder already exists: $folderPath";
        }
    }
}
