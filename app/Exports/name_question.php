<?php
namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class name_question implements FromArray, WithHeadings
{
    public function array(): array
    {
        // Lấy tên cột từ bảng
        $columns = DB::getSchemaBuilder()->getColumnListing('question');
        return [$columns];
    }

    public function headings(): array
    {
        return ['Column Names'];
    }
}
