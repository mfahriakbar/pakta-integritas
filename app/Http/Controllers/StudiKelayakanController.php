<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudiKelayakan;
use App\Exports\StudiKelayakanExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudiKelayakanMail;

class StudiKelayakanController extends Controller
{
    public function index(Request $request)
    {
        \Log::info('StudiKelayakanController index method started');

        $query = StudiKelayakan::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama_pengguna', 'like', "%{$searchTerm}%")
                    ->orWhere('alamat', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%")
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

        return view('admin.admin_penggunaJasa', compact('data'));
    }


    public function create()
    {
        return view('admin.admin_penggunajasaAdd');
    }

    public function store(Request $request)
    {
        // Validasi data form
        $validatedData = $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'alamat' => 'required|string',
            'hubungan' => 'required|string|max:255',
            'nama_penghubung' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telepon' => 'required|string|max:13',
            'nama_perusahaan' => 'required|in:Ya,Tidak',
            'nama_perorangan' => 'required|in:Ya,Tidak',
            'alamat_ada' => 'required|in:Ya,Tidak',
            'no_telp_ada' => 'required|in:Ya,Tidak',
            'email_ada' => 'required|in:Ya,Tidak',
            'pembayaran_langsung' => 'required|in:Ya,Tidak',
            'pembayaran_sebelum' => 'required|in:Ya,Tidak',
            'harga_sesuai' => 'required|in:Ya,Tidak',
            'no_identitas' => 'required|in:Ya,Tidak',
            'nama_pemilik' => 'required|in:Ya,Tidak',
            'kesimpulan' => 'required|in:Ya,Tidak',
            'tim_kepatuhan' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'nama_pelaksana' => 'required|string|max:255',
            'dokumen' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Pemformatan nama pengguna dan tim kepatuhan menjadi title case
        $namaPengguna = ucwords($validatedData['nama_pengguna']);
        $timKepatuhan = ucwords($validatedData['tim_kepatuhan']);

        // Simpan data studi kelayakan
        $studiKelayakan = StudiKelayakan::create([
            'nama_pengguna' => $namaPengguna,
            'alamat' => $validatedData['alamat'],
            'hubungan' => $validatedData['hubungan'],
            'nama_penghubung' => ucwords($validatedData['nama_penghubung']),
            'email' => $validatedData['email'],
            'no_telepon' => $validatedData['no_telepon'],
            'nama_perusahaan' => $validatedData['nama_perusahaan'],
            'nama_perorangan' => $validatedData['nama_perorangan'],
            'alamat_ada' => $validatedData['alamat_ada'],
            'no_telp_ada' => $validatedData['no_telp_ada'],
            'email_ada' => $validatedData['email_ada'],
            'pembayaran_langsung' => $validatedData['pembayaran_langsung'],
            'pembayaran_sebelum' => $validatedData['pembayaran_sebelum'],
            'harga_sesuai' => $validatedData['harga_sesuai'],
            'no_identitas' => $validatedData['no_identitas'],
            'nama_pemilik' => $validatedData['nama_pemilik'],
            'kesimpulan' => $validatedData['kesimpulan'],
            'tim_kepatuhan' => $timKepatuhan,
            'tempat' => $validatedData['tempat'],
            'tanggal' => $validatedData['tanggal'],
            'nama_pelaksana' => ucwords($validatedData['nama_pelaksana']),
        ]);

        // Handle file upload 
        if ($request->hasFile('dokumen')) {
            $filePath = $request->file('dokumen')->store('dokumen_files', 'public');
            $studiKelayakan->dokumen = $filePath;
            $studiKelayakan->save();
        }

        // Kirim email konfirmasi dengan link download jika bukan admin
        if ($request->input('is_admin') === 'true') {
            return redirect()->route('lapor.index')->with('success', 'Laporan berhasil disimpan');
        } else {
            $downloadLink = route('studi-kelayakan.download-pdf', $studiKelayakan->id);
            Mail::to($studiKelayakan->email)->send(new StudiKelayakanMail($studiKelayakan, $downloadLink));

            return response()->json([
                'message' => 'Laporan Anda berhasil dikirim! Email konfirmasi telah dikirim.',
                'data' => $studiKelayakan
            ]);
        }
    }


    public function destroy($id)
    {
        // Mencari data berdasarkan ID
        $data = StudiKelayakan::findOrFail($id);

        // Menghapus data
        $data->delete();

        // Redirect kembali ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('studi-kelayakan.index')->with('success', 'Data Berhasil Dihapus');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|max:255',
            'alamat' => 'required|string',
            'hubungan' => 'required|string|max:255',
            'nama_penghubung' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telepon' => 'required|string|max:13',
            'nama_perusahaan' => 'required|in:Ya,Tidak',
            'nama_perorangan' => 'required|in:Ya,Tidak',
            'alamat_ada' => 'required|in:Ya,Tidak',
            'no_telp_ada' => 'required|in:Ya,Tidak',
            'email_ada' => 'required|in:Ya,Tidak',
            'pembayaran_langsung' => 'required|in:Ya,Tidak',
            'pembayaran_sebelum' => 'required|in:Ya,Tidak',
            'harga_sesuai' => 'required|in:Ya,Tidak',
            'no_identitas' => 'required|in:Ya,Tidak',
            'nama_pemilik' => 'required|in:Ya,Tidak',
            'kesimpulan' => 'required|in:Ya,Tidak',
            'tim_kepatuhan' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'nama_pelaksana' => 'required|string|max:255',
            'dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $studiKelayakan = StudiKelayakan::findOrFail($id);
        $studiKelayakan->fill($request->except('dokumen'));
    
        // Handle file update
        if ($request->hasFile('dokumen')) {
            $filePath = $request->file('dokumen')->store('dokumen_files', 'public');
            $studiKelayakan->dokumen = $filePath;
        }
    
        $studiKelayakan->save();
    
        return redirect()->route('studi-kelayakan.index')->with('success', 'Data berhasil diupdate');
    }

    public function edit($id)
    {
        // Mencari data berdasarkan ID
        $data = StudiKelayakan::findOrFail($id);

        // Mengirimkan data ke view yang sesuai
        return view('admin.edit_penggunaJasa', compact('data'));
    }

    // export excel
    public function export($status = null)
    {
        return Excel::download(new StudiKelayakanExport($status), 'studi-kelayakan-' . ($status ?? 'semua') . '.xlsx');
    }

    // download pdf
    public function downloadPdf($id)
    {
        $data = StudiKelayakan::findOrFail($id);

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

        $dokumentPath = storage_path('app/public/' . $data->dokumen);
        $dokumentType = pathinfo($dokumentPath, PATHINFO_EXTENSION);
        $dokumentData = file_get_contents($dokumentPath);
        $dokumentBase64 = 'data:image/' . $dokumentType . ';base64,' . base64_encode($dokumentData);

        // Render view
        $html = view('template.template_studi_kelayakan', compact('data', 'qrcodeBase64', 'base64', 'dokumentBase64'))->render();

        // Generate PDF
        $pdf = PDF::loadHTML($html);

        // Generate a filename
        $filename = 'Studi-Kelayakan-' . Str::slug($data->nama_pengguna) . '.pdf';

        // Return the PDF for download
        return $pdf->download($filename);
    }


    public function viewLaporan($id)
    {
        // Temukan data berdasarkan ID
        $data = StudiKelayakan::findOrFail($id);

        // Generate QR Code
        $qrcodeSvg = QrCode::format('svg')->size(80)->generate(URL::to('/studi-kelayakan/' . $data->id));
        $qrcodeSvgClean = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $qrcodeSvg);
        $qrcodeBase64 = base64_encode($qrcodeSvgClean);

        // Path ke gambar kop surat yang akan digunakan dalam surat
        $path = public_path('assets/kop-surat.png'); // Add your image file here
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataGambar = file_get_contents($path);
        $base64Image = 'data:image/' . $type . ';base64,' . base64_encode($dataGambar);

        // Tampilkan view template laporan di browser
        return view('template.template_studi_kelayakan', compact('data', 'qrcodeBase64', 'base64Image'));
    }
}