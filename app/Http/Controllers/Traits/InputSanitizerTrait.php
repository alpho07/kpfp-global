<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait InputSanitizerTrait
{

    function sanitizeInput($input)
    {
        // Remove HTML tags and encode special characters
        $sanitizedInput = filter_var($input, FILTER_SANITIZE_STRING);

        // Replace special characters with underscores
        $sanitizedInput = str_replace([' ', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '+', '=', '{', '}', '[', ']', '|', ';', ':', ',', '.', '<', '>', '?', '/', '\\', "'", '"', '`', '~'], '_', $sanitizedInput);

        // Remove consecutive underscores
        $sanitizedInput = preg_replace('/_+/', '_', $sanitizedInput);

        // Trim underscores from the beginning and end
        $sanitizedInput = trim($sanitizedInput, '_');

        return $sanitizedInput;
    }


    function createFolderInPublic($folderPath)
    {
        // Check if the folder exists
        if (!Storage::exists($folderPath)) {
            // Create the folder
            Storage::makeDirectory($folderPath);

            echo "Folder created successfully: $folderPath";
        } else {
            echo "Folder already exists: $folderPath";
        }
    }
}
