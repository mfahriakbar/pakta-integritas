<?php

namespace App\Http\Controllers;

use App\Models\Dumas;
use App\Models\DumasComplaint;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DumasController extends Controller
{
    public function index(Request $request)
    {
        $query = DumasComplaint::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('activity_name', 'like', "%{$searchTerm}%")
                    ->orWhere('responsible', 'like', "%{$searchTerm}%")
                    ->orWhere('account_code', 'like', "%{$searchTerm}%");
            });
        }

        $sortColumn = $request->get('sort', 'created_at'); 
        $sortDirection = $request->get('direction', 'desc');

        // Check if the sort column is valid
        if (in_array($sortColumn, ['activity_name', 'responsible', 'account_code', 'created_at'])) {
            $query->orderBy($sortColumn, $sortDirection);
        } else {
            // Fallback to a default sort column if the provided one is invalid
            $query->orderBy('created_at', 'desc');
        }

        // Pagination
        $perPage = $request->get('per_page', 10);
        $data = $query->paginate($perPage);

        return view('admin.admin_dumas', compact('data'));
    }

    public function create()
    {
        return view('dumas.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate request
            $request->validate([
                'month' => 'required|string',
                'complaints' => 'required|array',
                'complaints.*.type' => 'nullable|string',
                'complaints.*.handling' => 'nullable|string',
                'complaints.*.remarks' => 'required|string'
            ]);

            // Create main Dumas record
            // If user is authenticated, use their ID, otherwise leave as null
            $created_by = auth()->check() ? auth()->id() : null;
            
            $dumas = Dumas::create([
                'month' => $request->month,
                'created_by' => $created_by
            ]);

            // Create complaint entries
            foreach ($request->complaints as $index => $complaintData) {
                $channelMap = [
                    0 => 'Kotak Pengaduan / Kotak Saran',
                    1 => 'Meja Pengaduan',
                    2 => 'Aplikasi Kaldu Emas (Pengaduan Masyarakat)',
                    3 => 'Aplikasi Lapor Pengaduan SPG',
                    4 => 'Aplikasi SP4N LAPOR'
                ];

                DumasComplaint::create([
                    'dumas_id' => $dumas->id,
                    'complaint_channel' => $channelMap[$index],
                    'complaint_type' => $complaintData['type'] ?? null,
                    'handling' => $complaintData['handling'] ?? null,
                    'remarks' => $complaintData['remarks']
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data pengaduan berhasil disimpan!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Dumas Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $dumas = Dumas::with('complaints')->findOrFail($id);
        return view('admin.dumas.show', compact('dumas'));
    }

    public function edit($id)
    {
        $dumas = Dumas::with('complaints')->findOrFail($id);
        return view('admin.dumas.edit', compact('dumas'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $dumas = Dumas::findOrFail($id);

            // Validate request
            $request->validate([
                'month' => 'required|string',
                'complaints' => 'required|array',
                'complaints.*.type' => 'nullable|string',
                'complaints.*.handling' => 'nullable|string',
                'complaints.*.remarks' => 'required|string'
            ]);

            // Update main record
            $dumas->update([
                'month' => $request->month
            ]);

            // Delete existing complaints
            $dumas->complaints()->delete();

            // Create new complaints
            foreach ($request->complaints as $index => $complaintData) {
                $channelMap = [
                    0 => 'Kotak Pengaduan / Kotak Saran',
                    1 => 'Meja Pengaduan',
                    2 => 'Aplikasi Kaldu Emas (Pengaduan Masyarakat)',
                    3 => 'Aplikasi Lapor Pengaduan SPG',
                    4 => 'Aplikasi SP4N LAPOR'
                ];

                DumasComplaint::create([
                    'dumas_id' => $dumas->id,
                    'complaint_channel' => $channelMap[$index],
                    'complaint_type' => $complaintData['type'],
                    'handling' => $complaintData['handling'],
                    'remarks' => $complaintData['remarks']
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data pengaduan berhasil diperbarui!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $dumas = Dumas::findOrFail($id);
            $dumas->delete();

            return redirect()->route('dumas.index')
                ->with('success', 'Data pengaduan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function downloadPdf($id)
    {

        try {
            $dumas = Dumas::with('complaints')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('dumas.index')->withErrors(['message' => 'Data tidak ditemukan']);
        }

        // Prepare letterhead image
        $path = public_path('assets/Picture1.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataGambar = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

        // Generate WhatsApp QR code
        $phoneNumber = '6281318131981';
        $waLink = 'https://wa.me/' . $phoneNumber;
        $qrCodeSvg = QrCode::format('svg')->size(80)->generate($waLink);
        $qrCodeSvgClean = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $qrCodeSvg);
        $qrCodeBase64 = base64_encode($qrCodeSvgClean);

        // Generate the PDF view
        $html = view('template.dumas_pdf', compact('dumas', 'base64', 'qrCodeBase64'))->render();
        $pdf = Pdf::loadHTML($html);

        // Sanitize filename
        $sanitizedFileName = str_replace(['\\', '/', ':', '*', '?', '"', '<', '>', '|'], '-', 
            'dumas_' . $dumas->month);

        // Download the PDF
        return $pdf->download($sanitizedFileName . '.pdf');
    }

}
