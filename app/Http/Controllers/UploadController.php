<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file|max:102400', // Max 10MB
            ]);

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Upload to Google Drive
            $path = Storage::disk('google')->put('/', $file);

            if ($path) {
                return response()->json([
                    'success' => true,
                    'message' => 'File berhasil diupload ke Google Drive',
                    'path' => $path
                ]);
            }

            throw new \Exception('Failed to upload file');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}