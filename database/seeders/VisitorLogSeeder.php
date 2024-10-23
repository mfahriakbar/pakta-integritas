<?php

namespace Database\Seeders;

use App\Models\VisitorLog;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VisitorLogSeeder extends Seeder
{
    public function run()
    {
        VisitorLog::create([
            'ip_address' => '192.168.1.1',
            'visit_date' => Carbon::now()->toDateString(),
        ]);

        VisitorLog::create([
            'ip_address' => '192.168.1.2',
            'visit_date' => Carbon::now()->toDateString(),
        ]);
    }
}
