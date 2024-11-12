<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpiP;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SpiPController extends Controller
{

    public function adminIndex(Request $request)
    {
        $query = SpiP::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('year', 'like', "%{$searchTerm}%")
                    ->orWhere('document_type', 'like', "%{$searchTerm}%")
                    ->orWhere('folder_path', 'like', "%{$searchTerm}%");
            });
        }

        // Sorting
        $sortColumn = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortColumn, $sortDirection);

        // Pagination
        $perPage = $request->get('per_page', 10);
        $data = $query->paginate($perPage);

        return view('admin.admin_spip', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'year' => 'required|string',
                'documentType' => 'required_if:year,2024|string',
                'additionalDocument' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:20480',
                'additionalInfo' => 'nullable|string',
            ]);

            // Build the folder path based on selected options
            $folderPath = $this->buildFolderPath($request);

            // Store the file
            $file = $request->file('additionalDocument');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs("public/spip/{$folderPath}", $fileName);

            // Create database record
            $spiP = SpiP::create([
                'year' => $validatedData['year'],
                'document_type' => $request->documentType ?? null,
                'folder_path' => $folderPath,
                'file_path' => $filePath,
                'additional_info' => $validatedData['additionalInfo'],
            ]);

            return response()->json([
                'message' => 'Dokumen berhasil diunggah!',
                'data' => $spiP
            ]);

        } catch (\Exception $e) {
            Log::error('Error in SpiP store: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengunggah dokumen.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function buildFolderPath(Request $request)
    {
        $folderPath = $request->year;

        if ($request->year === '2024') {
            $folderPath .= '/' . $request->documentType;

            if ($request->documentType === 'RiskControl') {
                $riskControlOption = $request->input('riskControlOptions');
                $folderPath .= '/' . $riskControlOption;

                if ($riskControlOption === 'EKSTERNAL') {
                    $folderPath .= '/' . $request->input('externalFolder');
                } elseif ($riskControlOption === 'INTERNAL') {
                    $internalFolder = $request->input('internalFolder');
                    $folderPath .= '/' . $internalFolder;

                    if ($internalFolder === 'Melakukan Sosialisasi') {
                        $folderPath .= '/' . $request->input('folderMelakukanSosialisasi');
                    } elseif ($internalFolder === 'Optimalisasi Semua Sistem Manajemen SNI ISO') {
                        $folderPath .= '/' . $request->input('folderOptimalisasiSistem');
                    }
                }
            }
        }

        return $folderPath;
    }

    public function show($id)
    {
        $spiP = SpiP::findOrFail($id);
        
        if (Storage::exists($spiP->file_path)) {
            return Storage::response($spiP->file_path);
        }
        
        return response()->json(['message' => 'File tidak ditemukan'], 404);
    }

    public function destroy($id)
    {
        try {
            $spiP = SpiP::findOrFail($id);
            
            // Delete file from storage
            if (Storage::exists($spiP->file_path)) {
                Storage::delete($spiP->file_path);
            }
            
            // Delete database record
            $spiP->delete();
            
            return redirect()->route('spip.admin')->with('success', 'Dokumen berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error in SpiP destroy: ' . $e->getMessage());
            return redirect()->route('spip.admin')->with('error', 'Gagal menghapus dokumen');
        }
    }
}