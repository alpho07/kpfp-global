<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\ApplicantsUploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use ZipArchive;

class DocumentManagerController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        //abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = auth()->user();
        $role = $user->roles()->pluck('name')->toArray();

        $query = ApplicantsUploads::query()->with(['student', 'document', 'institution', 'course']);

        if (in_array('Super Admin', $role)) {
        } elseif (in_array('Admin', $role)) {
        } else {
            $query->where('institution_id', session('institution_id'));
        }

        // Apply filters based on request parameters
        if ($request->filled('student_id')) {
            $query->where('student_id', $request->input('student_id'));
        }

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->input('course_id'));
        }

        if ($request->filled('document_id')) {
            $query->where('document_id', $request->input('document_id'));
        }

        if ($request->filled('institution_id')) {
            $query->where('institution_id', $request->input('institution_id'));
        }

        // Check if download is requested
        if ($request->has('download')) {
            return $this->downloadZip($query);
        }


        $documents = $query->orderBy('id','desc')->get();

        return view('admin.documents.index', compact('documents'));
    }

    private function downloadZip($query)
    {
        // Get the filtered documents
        $documents = $query->get();


        if ($documents->isEmpty()) {
            return redirect()->back()->with('error', 'No files found to download');
        }

        // Create a temporary file for the ZIP
        $zipFileName = 'documents_' . time() . '.zip';
        $zipFullPath = storage_path('app/temp/' . $zipFileName);

        // Ensure temp directory exists
        File::makeDirectory(storage_path('app/temp'), 0755, true, true);

        // Create ZIP archive
        $zip = new ZipArchive();
        if ($zip->open($zipFullPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            return redirect()->back()->with('error', 'Could not create ZIP file');
        }

        // Add files to ZIP
        foreach ($documents as $document) {
            $filePath = storage_path('app/public/' . $document->file_path);
            if (File::exists($filePath)) {
                // Use a unique name to avoid conflicts (e.g., include document ID)
                $fileName = $document->id . '_' . basename($document->file_path);
                $zip->addFile($filePath, $fileName);
            }
        }



        $zip->close();

        // Stream the file and delete it after download
        return response()->download($zipFullPath, $zipFileName)->deleteFileAfterSend(true);
    }
}
