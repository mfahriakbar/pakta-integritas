<?php

namespace App\Http\Controllers;

use App\Models\FkpForm;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\FkpFormSubmitted;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FkpFormExport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FkpController extends Controller
{

    // Admin view for managing FKP submissions
    public function adminIndex(Request $request)
    {
        \Log::info('AdminIndex method started');

        $query = FkpForm::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('employee_name', 'like', "%{$searchTerm}%")
                    ->orWhere('employee_id', 'like', "%{$searchTerm}%")
                    ->orWhere('subject', 'like', "%{$searchTerm}%")
                    ->orWhere('problem_description', 'like', "%{$searchTerm}%");
            });
        }

        \Log::info($query->toSql());

        // Sorting
        $sortColumn = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortColumn, $sortDirection);

        // Pagination
        $perPage = $request->get('per_page', 10);
        $data = $query->paginate($perPage);

        // Log the data to the log file
        \Log::info('Data fetched for adminIndex', ['data' => $data]);

        return view('admin.admin_fkp', compact('data')); // Admin view for listing FKP submissions
    }

    // Show the form to create a new FKP submission (admin)
    public function create()
    {
        return view('admin.admin_fkpAdd'); // Admin form creation view
    }

    // Store a new FKP submission
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'messageType' => 'required|string|in:Konsultasi,Partisipasi',
            'employeeName' => 'required|string|max:100',
            'employeeId' => 'required|string|max:50',
            'company' => 'nullable|string|max:100',
            'position' => 'required|string',
            'department' => 'required|string',
            'subject' => 'required|string',
            'problemDescription' => 'required|string',
            'proposedSolution' => 'required|string',
            'reporterEmail' => 'required|email',
            'notes' => 'nullable|string',
            'preparedBy' => 'nullable|string|max:100',
            'executor' => 'nullable|string|max:100',
            'secretaryApproval' => 'nullable|string|max:100',
            'chairmanApproval' => 'nullable|string|max:100',
        ]);

        $employeeName = ucwords($validatedData['employeeName']);

        $fkpForm = FkpForm::create([
            'message_type' => $validatedData['messageType'],
            'employee_name' => $employeeName,
            'employee_id' => $validatedData['employeeId'],
            'company' => $validatedData['company'],
            'position' => $validatedData['position'],
            'department' => $validatedData['department'],
            'subject' => $validatedData['subject'],
            'problem_description' => $validatedData['problemDescription'],
            'proposed_solution' => $validatedData['proposedSolution'],
            'reporter_email' => $validatedData['reporterEmail'],
            'notes' => $validatedData['notes'] ?? null,
            'prepared_by' => $validatedData['preparedBy'] ?? null,
            'executor' => $validatedData['executor'] ?? null,
            'secretary_approval' => $validatedData['secretaryApproval'] ?? null,
            'chairman_approval' => $validatedData['chairmanApproval'] ?? null,
        ]);

        if ($request->input('is_admin') === 'true') {
            return redirect()->route('fkp.index')->with('success', 'Form berhasil disimpan');
        } else {
            return response()->json([
                'message' => 'Form Anda berhasil dikirim! Email konfirmasi telah dikirim.',
                'data' => $fkpForm
            ]);
        }
    }

    // Edit FKP form submission
    public function edit($id)
    {
        $fkpForm = FkpForm::findOrFail($id);
        return view('admin.edit_fkp', compact('fkpForm')); // Admin view for editing FKP submission
    }

    // Update an existing FKP form submission
    public function update(Request $request, $id)
    {
        $fkpForm = FkpForm::findOrFail($id);

        $validatedData = $request->validate([
            'messageType' => 'required|string|in:Konsultasi,Partisipasi',
            'employeeName' => 'required|string|max:100',
            'employeeId' => 'required|string|max:50',
            'company' => 'nullable|string|max:100',
            'position' => 'required|string',
            'department' => 'required|string',
            'subject' => 'required|string',
            'problemDescription' => 'required|string',
            'proposedSolution' => 'required|string',
            'reporterEmail' => 'required|email',
            'notes' => 'nullable|string',
            'preparedBy' => 'nullable|string|max:100',
            'executor' => 'nullable|string|max:100',
            'secretaryApproval' => 'nullable|string|max:100',
            'chairmanApproval' => 'nullable|string|max:100',
        ]);

        $fkpForm->update([
            'message_type' => $validatedData['messageType'],
            'employee_name' => $validatedData['employeeName'],
            'employee_id' => $validatedData['employeeId'],
            'company' => $validatedData['company'],
            'position' => $validatedData['position'],
            'department' => $validatedData['department'],
            'subject' => $validatedData['subject'],
            'problem_description' => $validatedData['problemDescription'],
            'proposed_solution' => $validatedData['proposedSolution'],
            'reporter_email' => $validatedData['reporterEmail'],
            'notes' => $validatedData['notes'] ?? $fkpForm->notes,
            'prepared_by' => $validatedData['preparedBy'] ?? $fkpForm->prepared_by,
            'executor' => $validatedData['executor'] ?? $fkpForm->executor,
            'secretary_approval' => $validatedData['secretaryApproval'] ?? $fkpForm->secretary_approval,
            'chairman_approval' => $validatedData['chairmanApproval'] ?? $fkpForm->chairman_approval,
        ]);

        return redirect()->route('fkp.index')->with('success', 'Form berhasil diperbarui');
    }

    // Delete an FKP form submission
    public function destroy($id)
    {
        $fkpForm = FkpForm::findOrFail($id);
        $fkpForm->delete();

        return redirect()->route('fkp.index')->with('success', 'Form berhasil dihapus');
    }

    // Download FKP form as PDF
    public function downloadPdf($id)
    {
        $fkpForm = FkpForm::findOrFail($id);

        // Path to letterhead image
        $path = public_path('assets/kop-surat.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataGambar = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

        // Render view for the PDF
        $html = view('template.fkp_pdf', compact('fkpForm', 'base64'))->render();

        // Generate PDF
        $pdf = Pdf::loadHTML($html);

        // Clean the filename of invalid characters
        $sanitizedFileName = 'fkp_form_' . $fkpForm->id;

        // Download PDF
        return $pdf->download($sanitizedFileName . '.pdf');
    }

    // Export FKP forms to Excel
    public function exportExcel()
    {
        return Excel::download(new FkpFormExport, 'fkp_forms.xlsx');
    }

    // sendEmail method in FkpController
    public function sendEmail($id)
    {
        try {
            $fkpForm = FkpForm::findOrFail($id);
            
            // Get letterhead image and convert to base64
            $path = public_path('assets/kop-surat.png');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $dataGambar = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

            // Create temp directory if it doesn't exist
            $tempPath = storage_path('app/temp');
            if (!File::exists($tempPath)) {
                File::makeDirectory($tempPath, 0755, true);
            }

            // Generate PDF and save temporarily
            $pdf = PDF::loadView('template.fkp_pdf', [
                'fkpForm' => $fkpForm,
                'base64' => $base64
            ]);
            
            $pdfPath = storage_path('app/temp/fkp_form_' . $id . '.pdf');
            $pdf->save($pdfPath);

            // Send email
            Mail::to($fkpForm->reporter_email)->send(new FkpFormSubmitted($fkpForm));

            // Delete temporary PDF
            if (File::exists($pdfPath)) {
                File::delete($pdfPath);
            }

            return redirect()->back()->with('success-swal', 'Email berhasil dikirim!');
        } catch (\Exception $e) {
            \Log::error('Email sending error: ' . $e->getMessage());
            return redirect()->back()->with('error-swal', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }
}
