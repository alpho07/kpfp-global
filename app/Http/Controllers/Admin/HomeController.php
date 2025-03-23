<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

class HomeController
{
    public function index()
    {


        return view('admin.home');
    }




    function zipAndDownloadFiles($prefix_)
    {

        error_reporting(E_ALL);
        ini_set('display_errors', true);

        // Set the directory path where your files are located
        $directory = storage_path();


        // Set the pattern for files to include in the zip


        // Create a ZipArchive object
        $zip = new ZipArchive();

        // Create a temporary file to store the zip archive
        $tempFile = tempnam(sys_get_temp_dir(), 'zip');

        // Open the zip file for writing
        if ($zip->open($tempFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            die('Cannot open zip file');
        }

        // Get the list of files matching the pattern
        $files = glob($directory, $prefix_ . '*');

        dd($files);

        // Add each matching file to the zip archive
        foreach ($files as $file) {
            $zip->addFile($file, basename($file));
        }

        // Close the zip file
        $zip->close();

        // Set the headers to force a download
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename=download.zip');
        header('Content-Length: ' . filesize($tempFile));
        header('Pragma: no-cache');
        header('Expires: 0');

        // Read the zip file and output it to the browser
        readfile($tempFile);

        // Delete the temporary file
        unlink($tempFile);
    }




    function downloadZippedFiles()
    {

        $folderPath = '/path/to/your/folder'; // Change this to the path of your folder
        $zipFilePath = '/path/to/your/output.zip'; // Change this to the desired output zip file path

        // Create a ZipArchive object
        $zip = new ZipArchive();

        // Open the zip file for writing
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {

            // Create recursive directory iterator
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($folderPath),
                RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) {
                // Skip directories (we only want to add files)
                if (!$file->isDir()) {
                    // Get real and relative path for current file
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($folderPath) + 1);

                    // Add current file to archive
                    $zip->addFile($filePath, $relativePath);
                }
            }

            // Close the zip file
            $zip->close();

            echo "Zip archive created successfully.";
        } else {
            echo "Failed to create zip archive.";
        }
    }
}
