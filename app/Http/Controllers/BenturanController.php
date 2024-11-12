<?php

namespace App\Http\Controllers;

use App\Models\Benturan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\BenturanSubmitted;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BenturanExport;

class BenturanController extends Controller
{
    public function index(Request $request)
    {
        $query = Benturan::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('subject_position', 'like', "%{$searchTerm}%")
                    ->orWhere('activity_type', 'like', "%{$searchTerm}%");
            });
        }

        // Sorting
        $sortColumn = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortColumn, $sortDirection);

        // Pagination
        $perPage = $request->get('per_page', 10);
        $data = $query->paginate($perPage);

        return view('admin.admin_benturan', compact('data'));
    }

    public function create()
    {
        return view('admin.admin_benturanAdd');
    }

    public function store(Request $request)
    {
        try {
            // Validasi form data
            $validatedData = $request->validate([
                'subjectPosition' => 'required|string',
                'subjectPositionOther' => 'nullable|string',
                'activityType' => 'required|array',
                'activityType.*' => 'string',
                'situation' => 'required|array',
                'situation.*' => 'string',
                'conflictType' => 'required|array',
                'conflictType.*' => 'string',
                'penanganan' => 'required|array', // Changed from Penanganan
                'penanganan.*' => 'string',
                'declaration' => 'required|in:on',
                'reportOutcome' => 'required|string',
                'reportOutcomeOther' => 'nullable|string',
                'reportMonth' => 'required|string',
                'reportYear' => 'required|integer|min:2000|max:2100',
            ]);

            // Process arrays into strings
            $activityType = implode(', ', $validatedData['activityType']);
            $situation = implode(', ', $validatedData['situation']);
            $conflictType = implode(', ', $validatedData['conflictType']);
            $penanganan = implode(', ', $validatedData['penanganan']);

            // Determine subject position
            $subjectPosition = $validatedData['subjectPosition'];
            if ($subjectPosition === 'Lainnya' && !empty($validatedData['subjectPositionOther'])) {
                $subjectPosition = $validatedData['subjectPositionOther'];
            }

            // Determine report outcome
            $reportOutcome = $validatedData['reportOutcome'];
            if ($reportOutcome === 'Lainnya' && !empty($validatedData['reportOutcomeOther'])) {
                $reportOutcome = $validatedData['reportOutcomeOther'];
            }

            // Capture month and year from the form
            $reportMonth = $validatedData['reportMonth'];
            $reportYear = $validatedData['reportYear'];

            // Create record
            $benturan = Benturan::create([
                'subject_position' => $subjectPosition,
                'activity_type' => $activityType,
                'situation' => $situation,
                'conflict_type' => $conflictType,
                'handling_strategy' => $penanganan,
                'declaration' => true,
                'report_outcome' => $reportOutcome,
                'report_month' => $reportMonth,
                'report_year' => $reportYear,
            ]);

            // Handle response based on request source
            if ($request->input('is_admin') === 'true') {
                return redirect()->route('benturan.index')
                    ->with('success', 'Laporan benturan kepentingan berhasil disimpan');
            }

            return response()->json([
                'message' => 'Laporan benturan kepentingan berhasil dikirim!',
                'data' => $benturan
            ]);

        } catch (\Exception $e) {
            \Log::error('Benturan store error: ' . $e->getMessage());

            if ($request->input('is_admin') === 'true') {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data']);
            }

            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $benturan = Benturan::findOrFail($id);
        return view('admin.benturan.edit', compact('benturan'));
    }

    public function update(Request $request, $id)
    {
        // Find the Benturan model by its ID
        $benturan = Benturan::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'subjectPosition' => 'required|string',
            'subjectPositionOther' => 'nullable|string', 
            'activityType' => 'required|string',
            'situation' => 'required|string',
            'conflictType' => 'required|string',
            'Penanganan' => 'required|string',
            'declaration' => 'required|in:on',
            'report_outcome' => 'nullable|string', // Validasi untuk hasil laporan
            'reportOutcomeOther' => 'nullable|string', // Validasi untuk hasil laporan "Lainnya"
        ]);

        // Tentukan nilai untuk subject_position, bisa memilih dari dropdown atau menggunakan input "Lainnya"
        $subjectPosition = $validatedData['subjectPosition'];

        if ($subjectPosition === 'Lainnya' && isset($validatedData['subjectPositionOther'])) {
            $subjectPosition = $validatedData['subjectPositionOther'];
        }

        // Tentukan nilai untuk report_outcome dan reportOutcomeOther
        $reportOutcome = $validatedData['report_outcome'];
        $reportOutcomeOther = $validatedData['reportOutcomeOther'];

        // Update the Benturan record
        $benturan->update([
            'subject_position' => $subjectPosition,
            'activity_type' => $validatedData['activityType'],
            'situation' => $validatedData['situation'],
            'conflict_type' => $validatedData['conflictType'],
            'handling_strategy' => $validatedData['Penanganan'],
            'declaration' => true,  // Assuming declaration is always 'on'
            'report_outcome' => $reportOutcome,  // Update hasil laporan
            'reportOutcomeOther' => $reportOutcomeOther,  // Update hasil laporan "Lainnya" jika ada
        ]);

        // Redirect back with success message
        return redirect()->route('benturan.index')
            ->with('success', 'Laporan benturan kepentingan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $benturan = Benturan::findOrFail($id);
        
        if ($benturan->evidence) {
            Storage::disk('public')->delete($benturan->evidence);
        }
        
        $benturan->delete();

        return redirect()->route('benturan.index')
            ->with('success', 'Laporan benturan kepentingan berhasil dihapus');
    }

    public function downloadPdf(Request $request)
{
    $benturans = Benturan::orderBy('created_at', 'desc')->get();

    // Get the month name in Indonesian
    $monthNames = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    ];

    // Get the first record's month and year
    $periodText = '';
    if ($benturans->isNotEmpty()) {
        $firstRecord = $benturans->first();
        $monthName = $monthNames[$firstRecord->report_month] ?? $firstRecord->report_month;
        $periodText = $monthName . ' ' . $firstRecord->report_year;
    } else {
        $periodText = 'Tidak ada periode';
    }

    // Gambar pertama (kop surat)
    $pathKopSurat = public_path('assets/kop-surat.png');
    $typeKopSurat = pathinfo($pathKopSurat, PATHINFO_EXTENSION);
    $dataGambarKopSurat = file_get_contents($pathKopSurat);
    $base64KopSurat = 'data:image/' . $typeKopSurat . ';base64,' . base64_encode($dataGambarKopSurat);

    // Gambar kedua (Picture1)
    $pathPicture1 = public_path('assets/Picture1.png');
    $typePicture1 = pathinfo($pathPicture1, PATHINFO_EXTENSION);
    $dataGambarPicture1 = file_get_contents($pathPicture1);
    $base64Picture1 = 'data:image/' . $typePicture1 . ';base64,' . base64_encode($dataGambarPicture1);

    $html = view('template.benturan_pdf', compact('benturans', 'base64KopSurat', 'base64Picture1', 'periodText'))->render();
    $pdf = Pdf::loadHTML($html);

    return $pdf->download('laporan_benturan_kepentingan.pdf');
}

public function previewPdf()
{
    $benturans = Benturan::orderBy('created_at', 'desc')->get();

    // Get the month name in Indonesian
    $monthNames = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    ];

    // Get the first record's month and year
    $periodText = '';
    if ($benturans->isNotEmpty()) {
        $firstRecord = $benturans->first();
        $monthName = $monthNames[$firstRecord->report_month] ?? $firstRecord->report_month;
        $periodText = $monthName . ' ' . $firstRecord->report_year;
    } else {
        $periodText = 'Tidak ada periode';
    }

    $path = public_path('assets/kop-surat.png');
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $dataGambar = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

    $html = view('template.benturan_pdf', compact('benturans', 'base64', 'periodText'))->render();
    $pdf = Pdf::loadHTML($html);

    return $pdf->stream('laporan_benturan_kepentingan.pdf');
}
}
