<?php

namespace App\Exports;

use App\Models\Benturan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BenturanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch all benturan records
        return Benturan::all(['id', 'subject_position', 'activity_type', 'situation', 'conflict_type', 'handling_strategy', 'created_at']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Subject Position',
            'Activity Type',
            'Situation',
            'Conflict Type',
            'Handling Strategy',
            'Created At',
        ];
    }
}
