<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorLog;
use Carbon\Carbon;

class VisitorController extends Controller
{
    public function index()
    {
        // Mendapatkan IP pengunjung dan tanggal hari ini
        $ipAddress = request()->ip();
        $today = Carbon::now()->toDateString();

        // Cek apakah pengunjung sudah tercatat hari ini
        $existingVisit = VisitorLog::where('ip_address', $ipAddress)
                                   ->where('visit_date', $today)
                                   ->first();

        // Jika pengunjung belum tercatat, simpan data pengunjung baru
        if (!$existingVisit) {
            VisitorLog::create([
                'ip_address' => $ipAddress,
                'visit_date' => $today,
            ]);
        }

        return view('welcome');
    }

    public function showVisitorStats()
    {
        $today = Carbon::now()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        // Menghitung jumlah pengunjung hari ini
        $todayVisits = VisitorLog::where('visit_date', $today)->count();

        // Menghitung jumlah pengunjung kemarin
        $yesterdayVisits = VisitorLog::where('visit_date', $yesterday)->count();

        // Menghitung total pengunjung
        $totalVisits = VisitorLog::count();

        return view('visitor-stats', compact('todayVisits', 'yesterdayVisits', 'totalVisits'));
    }
}
