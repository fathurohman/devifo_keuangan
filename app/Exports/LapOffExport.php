<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithTitle;

class LapOffExport implements FromView, ShouldAutoSize, WithStrictNullComparison, WithTitle
{
    protected $start, $end, $data;

    function __construct($start, $end, $data, $sum_debit2, $sum_credit2)
    {
        $this->start = $start;
        $this->end = $end;
        $this->data = $data;
        $this->sum_debit2 = $sum_debit2;
        $this->sum_credit2 = $sum_credit2;
    }

    public function view(): View
    {
        $data = $this->data;
        $start = $this->start;
        $end = $this->end;
        $sum_debit2 = $this->sum_debit2;
        $sum_credit2 = $this->sum_credit2;

        return view('lap_offline.reports.table_excel', ['data' => $data, 'start' => $start, 'end' => $end, 'sum_debit' => $sum_debit2, 'sum_credit' => $sum_credit2]);
    }

    public function title(): string
    {
        return 'laporan_offline';
    }


}
