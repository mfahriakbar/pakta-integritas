<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenyediaJasa;
use App\Exports\PenyediaJasaExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PenyediaJasaController extends Controller
{
    public function index(Request $request)
    {
        \Log::info('PenyediaJasaController index method started');

        $query = PenyediaJasa::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama_rekan', 'like', "%{$searchTerm}%")
                    ->orWhere('alamat', 'like', "%{$searchTerm}%")
                    ->orWhere('pegawai_penghubung', 'like', "%{$searchTerm}%")
                    ->orWhere('no_telepon', 'like', "%{$searchTerm}%");
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
        \Log::info('Data fetched for index method', ['count' => $data->count()]);

        return view('admin.admin_penyediaJasa', compact('data'));
    }

    public function create()
    {
        return view('admin.admin_penyediajasaAdd');
    }

    public function store(Request $request)
    {
        // Validasi data form
        $validatedData = $request->validate([
            'nama_rekan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'hubungan' => 'required|string|max:255',
            'pegawai_penghubung' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:13',
            'legalitas' => 'required|in:Sesuai,Tidak Sesuai',
            'kualifikasi' => 'required|in:Unit Dagang,CV,PT,Lainnya',
            'sumber_daya' => 'required|in:Sesuai,Tidak Sesuai',
            'anti_penyuapan' => 'required|in:Iya,Tidak',
            'kasus_penyuapan' => 'required|in:Iya,Tidak',
            'mekanisme_transaksi' => 'required|string|max:255',
            'nib' => 'required|string|max:255',
            'kesimpulan' => 'required|in:Memenuhi Persyaratan,Tidak Memenuhi Persyaratan',
            'tim_kepatuhan' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        // Pemformatan nama rekan dan tim kepatuhan menjadi title case
        $namaRekan = ucwords($validatedData['nama_rekan']);
        $timKepatuhan = ucwords($validatedData['tim_kepatuhan']);
        $pegawaiPenghubung = ucwords($validatedData['tim_kepatuhan']);

        try {
            // Menyimpan Data ke Database
            PenyediaJasa::create([
                'nama_rekan' => $namaRekan,
                'alamat' => $validatedData['alamat'],
                'hubungan' => $validatedData['hubungan'],
                'pegawai_penghubung' => $pegawaiPenghubung,
                'no_telepon' => $validatedData['no_telepon'],
                'legalitas' => $validatedData['legalitas'],
                'kualifikasi' => $validatedData['kualifikasi'],
                'sumber_daya' => $validatedData['sumber_daya'],
                'anti_penyuapan' => $validatedData['anti_penyuapan'],
                'kasus_penyuapan' => $validatedData['kasus_penyuapan'],
                'mekanisme_transaksi' => $validatedData['mekanisme_transaksi'],
                'nib' => $validatedData['nib'],
                'kesimpulan' => $validatedData['kesimpulan'],
                'tempat' => $validatedData['tempat'],
                'tanggal' => $validatedData['tanggal'],
                'tim_kepatuhan' => $timKepatuhan,
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Formulir telah berhasil dikirim!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $data = PenyediaJasa::findOrFail($id);
        $data->delete();

        return redirect()->route('penyedia-jasa.index')->with('success', 'Laporan berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_rekan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'hubungan' => 'required|string|max:255',
            'pegawai_penghubung' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:13',
            'legalitas' => 'required|in:Sesuai,Tidak Sesuai',
            'kualifikasi' => 'required|in:Unit Dagang,CV,PT,Lainnya',
            'sumber_daya' => 'required|in:Sesuai,Tidak Sesuai',
            'anti_penyuapan' => 'required|in:Iya,Tidak',
            'kasus_penyuapan' => 'required|in:Iya,Tidak',
            'mekanisme_transaksi' => 'required|string|max:255',
            'nib' => 'required|string|max:255',
            'kesimpulan' => 'required|in:Memenuhi Persyaratan,Tidak Memenuhi Persyaratan',
            'tim_kepatuhan' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        $penyediaJasa = PenyediaJasa::findOrFail($id);
        $penyediaJasa->fill($request->all());
        $penyediaJasa->save();
        
        return redirect()->route('penyedia-jasa.index')->with('success', 'Data berhasil diupdate');
    }

    public function edit($id)
    {
        // Mencari data berdasarkan ID
        $data = PenyediaJasa::findOrFail($id);

        // Mengirimkan data ke view yang sesuai
        return view('admin.edit_penyediaJasa', compact('data'));
    }

    // export excel
    public function export($status = null)
    {
        return Excel::download(new PenyediaJasaExport($status), 'penyedia-jasa-' . ($status ?? 'semua') . '.xlsx');
    }

    // download pdf
    public function downloadPdf($id)
    {
        $data = PenyediaJasa::findOrFail($id);

        // Generate QR Code
        $phone = '62' . ltrim($data->no_telepon, '0');
        $waLink = 'https://wa.me/' . $phone;
        $qrcodeSvg = QrCode::format('svg')->size(80)->generate($waLink);
        $qrcodeSvgClean = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $qrcodeSvg);
        $qrcodeBase64 = base64_encode($qrcodeSvgClean);

        // Path to the image used in the header
        $path = public_path('assets/kop-surat.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataGambar = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

        // Render view
        $html = view('template.template_penyedia_jasa', compact('data', 'qrcodeBase64', 'base64'))->render();

        // Generate PDF
        $pdf = PDF::loadHTML($html);

        // Generate a filename
        $filename = 'Penyedia-Jasa-' . Str::slug($data->nama_rekan) . '.pdf';

        // Return the PDF for download
        return $pdf->download($filename);
    }

    public function viewLaporan($id)
    {
        // Temukan data berdasarkan ID
        $data = PenyediaJasa::findOrFail($id);

        // Generate QR Code
        $qrcodeSvg = QrCode::format('svg')->size(80)->generate(URL::to('/penyedia-jasa/' . $data->id));
        $qrcodeSvgClean = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $qrcodeSvg);
        $qrcodeBase64 = base64_encode($qrcodeSvgClean);

        // Path ke gambar kop surat yang akan digunakan dalam surat
        $path = public_path('assets/kop-surat.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataGambar = file_get_contents($path);
        $base64Image = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

        // Tampilkan view template laporan di browser
        return view('template.template_penyedia_jasa', compact('data', 'qrcodeBase64', 'base64Image'));
    }
}