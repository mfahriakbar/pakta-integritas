<?php

namespace App\Http\Controllers;

use App\Models\LaporK3;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\LaporK3Submitted;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporK3Export;
use Illuminate\Support\Facades\Storage;

class K3Controller extends Controller
{

    public function Index(Request $request)
    {
        \Log::info('AdminIndex method started');

        $query = LaporK3::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('reporter', 'like', "%{$searchTerm}%")
                  ->orWhere('department', 'like', "%{$searchTerm}%")
                  ->orWhere('incident_type', 'like', "%{$searchTerm}%");
            });
        }

        // Sorting
        $sortColumn = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortColumn, $sortDirection);

        // Pagination
        $perPage = $request->get('per_page', 10);
        $data = $query->paginate($perPage);

        \Log::info('Data fetched for adminIndex', ['data' => $data]);

        return view('admin.admin_k3', compact('data'));
    }

    public function create()
    {
        return view('admin.k3_create');
    }

    public function store(Request $request)
{
    // Validasi data form
    $validatedData = $request->validate([
        'incidentDate' => 'required|date',
        'incidentTime' => 'required|date_format:H:i',
        'location' => 'required|string',
        'department' => 'required|string',
        'incidentType' => 'required|string',
        'treatment' => 'required|string',
        'repeatedIncident' => 'required|in:Ya,Tidak',
        'incidentNumber' => 'nullable|integer',
        'potentialAssessment' => 'required|string',
        'description' => 'required|string',
        'evidence' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:20480',
        'causeAnalysis' => 'required|string',
        'immediateActions' => 'required|string',
        'correctiveActions' => 'required|string',
        'reporter' => 'required|string',
        'victims' => 'required|string',
        'witnesses' => 'required|string',
        'supervisor' => 'required|string',
        'reporterSignature' => 'required|string',
        'reporterEmail' => 'required|email',
        'supervisorSignature' => 'required|string',
        'reportDate' => 'required|date',
        'is_admin' => 'required|in:false,true',  // Validasi untuk memastikan is_admin ada dan benar
    ]);

    // Proses dan simpan data
    $laporK3 = LaporK3::create([
        'incident_date' => $validatedData['incidentDate'],
        'incident_time' => $validatedData['incidentTime'],
        'location' => $validatedData['location'],
        'department' => $validatedData['department'],
        'incident_type' => $validatedData['incidentType'],
        'treatment' => $validatedData['treatment'],
        'repeated_incident' => $validatedData['repeatedIncident'],
        'incident_number' => $validatedData['incidentNumber'],
        'potential_assessment' => $validatedData['potentialAssessment'],
        'description' => $validatedData['description'],
        'cause_analysis' => $validatedData['causeAnalysis'],
        'immediate_actions' => $validatedData['immediateActions'],
        'corrective_actions' => $validatedData['correctiveActions'],
        'reporter' => $validatedData['reporter'],
        'victims' => $validatedData['victims'],
        'witnesses' => $validatedData['witnesses'],
        'supervisor' => $validatedData['supervisor'],
        'reporterSignature' => $validatedData['reporterSignature'],
        'reporter_email' => $validatedData['reporterEmail'],
        'supervisorSignature' => $validatedData['supervisorSignature'],
        'report_date' => $validatedData['reportDate'],
    ]);

    // Tangani upload file (jika ada)
    if ($request->hasFile('evidence')) {
        $filePath = $request->file('evidence')->store('evidence_files', 'public');
        $laporK3->evidence = $filePath;
        $laporK3->save();
    }

    // Jika form dikirim oleh admin, redirect ke index admin
    if ($request->input('is_admin') === 'true') {
        return redirect()->route('lapork3.index')->with('success', 'Laporan K3 berhasil disimpan.');
    } else {
        // Kirim email konfirmasi ke pelapor jika ini laporan dari user
        $downloadLink = route('laporank3.pdf', $laporK3->id);
        Mail::to($laporK3->reporter_email)->send(new LaporK3Submitted($laporK3, $downloadLink));

        return response()->json([
            'message' => 'Laporan K3 Anda berhasil dikirim! Email konfirmasi telah dikirim.',
            'data' => $laporK3
        ]);
    }
}

    public function edit($id)
    {
        $laporK3 = LaporK3::findOrFail($id);
        return view('admin.edit_k3', compact('laporK3'));
    }

    public function update(Request $request, $id)
    {
        $laporK3 = LaporK3::findOrFail($id);

        $validatedData = $request->validate([
            'incidentDate' => 'required|date',
            'incidentTime' => 'required|date_format:H:i',
            'location' => 'required|string',
            'department' => 'required|string',
            'incidentType' => 'required|string',
            'treatment' => 'required|string',
            'repeatedIncident' => 'required|in:Ya,Tidak',
            'incidentNumber' => 'nullable|integer',
            'potentialAssessment' => 'required|string',
            'description' => 'required|string',
            'evidence' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:20480',
            'causeAnalysis' => 'required|string',
            'immediateActions' => 'required|string',
            'correctiveActions' => 'required|string',
            'reporter' => 'required|string',
            'victims' => 'required|string',
            'witnesses' => 'required|string',
            'supervisor' => 'required|string',
            'reporterSignature' => 'nullable|string',
            'reporterEmail' => 'required|email',
            'supervisorSignature' => 'nullable|string',
        ]);

        if ($request->hasFile('evidence')) {
            if ($laporK3->evidence) {
                \Storage::delete($laporK3->evidence); // Delete existing file if it exists
            }

            $filePath = $request->file('evidence')->store('evidence_files');
            $laporK3->evidence = $filePath;
            $laporK3->save();
        }

        return redirect()->route('lapork3.index')->with('success', 'Laporan K3 berhasil diperbarui');
    }

    public function destroy($id)
    {
        $laporK3 = LaporK3::findOrFail($id);
        $laporK3->delete();

        return redirect()->route('lapork3.index')->with('success', 'Laporan K3 berhasil dihapus');
    }

    public function downloadPdf($id)
    {
        try {
            $laporK3 = LaporK3::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('lapork3.index')->withErrors(['message' => 'Data tidak ditemukan']);
        }

        $judul = 'Laporan Insiden dan Kecelakaan K3';

        // Generate QR Code for reporter
        $reporterPhone = '62' . ltrim($laporK3->reporterSignature, '0');
        $reporterWaLink = 'https://wa.me/' . $reporterPhone;
        $reporterQrCodeSvg = QrCode::format('svg')->size(80)->generate($reporterWaLink);
        $reporterQrCodeSvgClean = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $reporterQrCodeSvg);
        $reporterQrCode = base64_encode($reporterQrCodeSvgClean);

        // Generate QR Code for supervisor
        $supervisorPhone = '62' . ltrim($laporK3->supervisorSignature, '0');
        $supervisorWaLink = 'https://wa.me/' . $supervisorPhone;
        $supervisorQrCodeSvg = QrCode::format('svg')->size(80)->generate($supervisorWaLink);
        $supervisorQrCodeSvgClean = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $supervisorQrCodeSvg);
        $supervisorQrCode = base64_encode($supervisorQrCodeSvgClean);

        // Get letterhead image
        $path = public_path('assets/kop-surat.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataGambar = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

        // Render view
        $html = view('template.k3_pdf', compact('laporK3', 'base64', 'judul', 'reporterQrCode', 'supervisorQrCode'))->render();

        // Generate PDF
        $pdf = PDF::loadHTML($html);

        // Generate a filename
        $filename = 'Laporan-K3-' . Str::slug($laporK3->reporter) . '-' . $laporK3->id . '.pdf';

        // Return the PDF for download
        return $pdf->download($filename);
    }

    // Add this new method to format phone numbers
    private function formatPhoneNumber($phoneNumber)
    {
        // Remove any non-digit characters
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        // If the number starts with '0', replace it with '62'
        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        }

        // If the number doesn't start with '62', add it
        if (substr($phoneNumber, 0, 2) !== '62') {
            $phoneNumber = '62' . $phoneNumber;
        }

        return $phoneNumber;
    }

    public function exportExcel()
    {
        return Excel::download(new LaporK3Export, 'laporan_k3.xlsx');
    }

    public function previewPdf($id)
    {
        try {
            $laporK3 = LaporK3::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('lapork3.index')->withErrors(['message' => 'Data tidak ditemukan']);
        }

        $judul = 'Laporan Insiden dan Kecelakaan K3';
        $path = public_path('assets/kop-surat.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataGambar = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

        $html = view('template.k3_pdf', compact('laporK3', 'base64', 'judul'))->render();
        $pdf = Pdf::loadHTML($html);

        return $pdf->stream('laporan_k3_' . $laporK3->id . '.pdf');
    }
}