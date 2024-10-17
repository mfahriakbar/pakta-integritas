<?php

namespace App\Http\Controllers;

use App\Models\LaporK3;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\LaporK3Submitted;
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
        return view('k3.create');
    }

    public function store(Request $request)
    {
        // Validate form data
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
            'causeAnalysis' => 'required|string',
            'immediateActions' => 'required|string',
            'correctiveActions' => 'required|string',
            'reporter' => 'required|string',
            'victims' => 'required|string',
            'witnesses' => 'required|string',
            'supervisor' => 'required|string',
            'reporterSignature' => 'required|image|max:2048',
            'supervisorSignature' => 'required|image|max:2048',
        ]);

        // Process and store data
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
        ]);

        // Handle file uploads
        if ($request->hasFile('reporterSignature')) {
            $reporterSignaturePath = $request->file('reporterSignature')->store('signatures', 'public');
            $laporK3->reporter_signature = $reporterSignaturePath;
        }

        if ($request->hasFile('supervisorSignature')) {
            $supervisorSignaturePath = $request->file('supervisorSignature')->store('signatures', 'public');
            $laporK3->supervisor_signature = $supervisorSignaturePath;
        }

        $laporK3->save();

        // Check if the request is from admin
        if ($request->input('is_admin') === 'true') {
            return redirect()->route('k3.index')->with('success', 'Laporan K3 berhasil disimpan');
        } else {
            $downloadLink = route('k3.pdf', $laporK3->id);
            Mail::to($request->user()->email)->send(new LaporK3Submitted($laporK3, $downloadLink));

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
            'causeAnalysis' => 'required|string',
            'immediateActions' => 'required|string',
            'correctiveActions' => 'required|string',
            'reporter' => 'required|string',
            'victims' => 'required|string',
            'witnesses' => 'required|string',
            'supervisor' => 'required|string',
            'reporterSignature' => 'nullable|image|max:2048',
            'supervisorSignature' => 'nullable|image|max:2048',
        ]);

        $laporK3->update($validatedData);

        // Handle file uploads if new signatures are provided
        if ($request->hasFile('reporterSignature')) {
            Storage::delete($laporK3->reporter_signature);
            $reporterSignaturePath = $request->file('reporterSignature')->store('signatures', 'public');
            $laporK3->reporter_signature = $reporterSignaturePath;
        }

        if ($request->hasFile('supervisorSignature')) {
            Storage::delete($laporK3->supervisor_signature);
            $supervisorSignaturePath = $request->file('supervisorSignature')->store('signatures', 'public');
            $laporK3->supervisor_signature = $supervisorSignaturePath;
        }

        $laporK3->save();

        return redirect()->route('k3.index')->with('success', 'Laporan K3 berhasil diperbarui');
    }

    public function destroy($id)
    {
        $laporK3 = LaporK3::findOrFail($id);
        Storage::delete([$laporK3->reporter_signature, $laporK3->supervisor_signature]);
        $laporK3->delete();

        return redirect()->route('k3.index')->with('success', 'Laporan K3 berhasil dihapus');
    }

    public function downloadPdf($id)
    {
        try {
            $laporK3 = LaporK3::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('k3.index')->withErrors(['message' => 'Data tidak ditemukan']);
        }

        $judul = 'Laporan Insiden dan Kecelakaan K3';
        $path = public_path('assets/kop-surat.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataGambar = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

        $html = view('template.k3_pdf', compact('laporK3', 'base64', 'judul'))->render();
        $pdf = Pdf::loadHTML($html);

        $sanitizedFileName = str_replace(['\\', '/', ':', '*', '?', '"', '<', '>', '|'], '-', 'laporan_k3_' . $laporK3->id);

        return $pdf->download($sanitizedFileName . '.pdf');
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
            return redirect()->route('k3.index')->withErrors(['message' => 'Data tidak ditemukan']);
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