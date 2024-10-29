<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Participant;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Exports\ActivitiesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('activity_name', 'like', "%{$searchTerm}%")
                    ->orWhere('responsible', 'like', "%{$searchTerm}%")
                    ->orWhere('account_code', 'like', "%{$searchTerm}%");
            });
        }

        // Sorting
        $sortColumn = $request->get('sort', 'activity_date');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortColumn, $sortDirection);

        // Pagination
        $perPage = $request->get('per_page', 10);
        $data = $query->paginate($perPage);

        return view('admin.admin_absen', compact('data'));
    }

    public function create()
    {
        return view('admin.admin_absenAdd');
    }

    public function store(Request $request)
    {
        \Log::info('Request data:', $request->all());
        try {
            DB::beginTransaction();

            // Validate main activity data
            $validatedData = $request->validate([
                'activityName' => 'required|string|max:255',
                'activityDate' => 'required|date',
                'responsible' => 'required|string|max:255',
                'participantCount' => 'required|integer|min:1',
                'accountCode' => 'nullable|string|max:255',
                'objective' => 'required|string',
                'summary' => 'required|string',
                'participants' => 'required|array|min:1',
                'participants.*.name' => 'required|string|max:255',
                'participants.*.position' => 'required|string|max:255',
                'participants.*.no_telepon' => 'required|string|regex:/^\d{8,13}$/'
            ]);

            // Create activity
            $activity = Activity::create([
                'activity_name' => $validatedData['activityName'],
                'activity_date' => $validatedData['activityDate'],
                'responsible' => $validatedData['responsible'],
                'participant_count' => $validatedData['participantCount'],
                'account_code' => $validatedData['accountCode'],
                'objective' => $validatedData['objective'],
                'summary' => $validatedData['summary']
            ]);

            // Create participants
            foreach ($validatedData['participants'] as $participantData) {
                Participant::create([
                    'activity_id' => $activity->id,
                    'name' => $participantData['name'],
                    'position' => $participantData['position'],
                    'phone_number' => '+62' . $participantData['no_telepon']
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data aktivitas berhasil disimpan!'
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Error storing activity: ' . $e->getMessage());
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $attendance = Activity::with('participants')->findOrFail($id);
        return view('admin.edit_absen', compact('attendance'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $activity = Activity::findOrFail($id);

            // Validate main activity data
            $validatedData = $request->validate([
                'activityName' => 'required|string|max:255',
                'activityDate' => 'required|date',
                'responsible' => 'required|string|max:255',
                'participantCount' => 'required|integer|min:1',
                'accountCode' => 'nullable|string|max:255',
                'objective' => 'required|string',
                'summary' => 'required|string',
                'participants' => 'required|array|min:1',
                'participants.*.name' => 'required|string|max:255',
                'participants.*.position' => 'required|string|max:255',
                'participants.*.no_telepon' => 'required|string|regex:/^\d{8,13}$/'
            ]);

            // Update activity
            $activity->update([
                'activity_name' => $validatedData['activityName'],
                'activity_date' => $validatedData['activityDate'],
                'responsible' => $validatedData['responsible'],
                'participant_count' => $validatedData['participantCount'],
                'account_code' => $validatedData['accountCode'],
                'objective' => $validatedData['objective'],
                'summary' => $validatedData['summary']
            ]);

            // Delete existing participants and create new ones
            $activity->participants()->delete();
            
            foreach ($validatedData['participants'] as $participantData) {
                Participant::create([
                    'activity_id' => $activity->id,
                    'name' => $participantData['name'],
                    'position' => $participantData['position'],
                    'phone_number' => '+62' . $participantData['no_telepon']
                ]);
            }

            DB::commit();

            return redirect()->route('activities.index')
                ->with('success', 'Data aktivitas berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function export()
    {
        return Excel::download(new ActivitiesExport, 'activities.xlsx');
    }

    public function destroy($id)
    {
        try {
            $activity = Activity::findOrFail($id);
            $activity->delete();

            return redirect()->route('activities.index')
                ->with('success', 'Data aktivitas berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    public function downloadPdf($id)
    {
        try {
            $activity = Activity::with('participants')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('absen.index')->withErrors(['message' => 'Data tidak ditemukan']);
        }

        // Prepare letterhead image
        $path = public_path('assets/kop-surat.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataGambar = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

        // Generate QR codes for participants
        $participantsWithQrCodes = $activity->participants->map(function ($participant) {
            $phone = '62' . ltrim($participant->phone_number, '0'); // Adjust phone number format
            $waLink = 'https://wa.me/' . $phone; // WhatsApp link
            $qrCodeSvg = QrCode::format('svg')->size(80)->generate($waLink);
            $qrCodeSvgClean = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $qrCodeSvg);
            $participant->qr_code = base64_encode($qrCodeSvgClean);
            return $participant;
        });

        // Generate the PDF view
        $html = view('template.template_absen', compact('activity', 'base64', 'participantsWithQrCodes'))->render();
        $pdf = Pdf::loadHTML($html);

        // Sanitize filename
        $sanitizedFileName = str_replace(['\\', '/', ':', '*', '?', '"', '<', '>', '|'], '-', 
            'absensi_' . $activity->activity_name . '_' . $activity->activity_date);

        // Download the PDF
        return $pdf->download($sanitizedFileName . '.pdf');
    }

    public function previewPdf($id)
    {
        try {
            $activity = Activity::with('participants')->findOrFail($id);
            
            // Get letterhead image
            $path = public_path('assets/kop-surat.png');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $dataGambar = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

            // Generate PDF
            $html = view('template.activity_pdf', compact('activity', 'base64'))->render();
            $pdf = Pdf::loadHTML($html);

            return $pdf->stream('preview_rekaman_kegiatan.pdf');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat preview PDF: ' . $e->getMessage());
        }
    }
}