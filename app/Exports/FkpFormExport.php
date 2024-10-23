<?php

namespace App\Exports;

use App\Models\FkpForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class FkpFormExport implements FromCollection, WithHeadings, WithStyles, WithTitle, WithColumnFormatting
{
    // Return a collection of all FKP forms
    public function collection()
    {
        return FkpForm::all([
            'employee_name', 'employee_id', 'company', 'position', 'department', 
            'subject', 'problem_description', 'proposed_solution', 'reporter_email', 
            'message_type', 'created_at'
        ]);
    }

    // Add headings for the Excel export
    public function headings(): array
    {
        return [
            'Employee Name', 'Employee ID', 'Company', 'Position', 'Department', 
            'Subject', 'Problem Description', 'Proposed Solution', 'Reporter Email', 
            'Message Type', 'Created At'
        ];
    }

    // Apply styles to the exported sheet
    public function styles($sheet)
    {
        return [
            // Set bold for headings
            1    => ['font' => ['bold' => true]],
        ];
    }

    // Set the title for the sheet
    public function title(): string
    {
        return 'FKP Forms'; // Sheet name
    }

    // Format the columns (e.g., date formatting)
    public function columnFormats(): array
    {
        return [
            'K' => 'yyyy-mm-dd', // Date formatting for created_at
        ];
    }
}
