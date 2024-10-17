<?php

namespace App\Exports;

use App\Models\LaporK3;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporK3Export implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LaporK3::all();
    }
}
