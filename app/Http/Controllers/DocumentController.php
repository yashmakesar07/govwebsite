<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class DocumentController extends Controller
{
    public function download($id)
    {
        $document = Document::findOrFail($id);

        $path = $document->file_path;

        // Check if file exists in storage/app/public/
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->download($path, basename($path), [
                'Content-Type' => $document->mime_type ?: 'application/pdf',
            ]);
        }

        // Check relative to public directory
        $publicPath = public_path($path);
        if (file_exists($publicPath)) {
            return response()->download($publicPath, basename($publicPath), [
                'Content-Type' => $document->mime_type ?: 'application/pdf',
            ]);
        }

        abort(404, 'The requested official document was not found.');
    }
}
