<?php

namespace App\Exports;

use App\Models\Activity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivitiesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Activity::with('participants')->get();
    }

    public function headings(): array
    {
        return [
            'Activity Name',
            'Activity Date',
            'Responsible',
            'Participant Count',
            'Account Code',
            'Objective',
            'Summary',
            'Participants'
        ];
    }
}