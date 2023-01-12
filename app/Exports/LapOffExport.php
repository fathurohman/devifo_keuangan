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
    protected $bulan, $tahun, $data;

    function __construct($bulan, $tahun, $data, $sum_debit2, $sum_credit2)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->data = $data;
        $this->sum_debit2 = $sum_debit2;
        $this->sum_credit2 = $sum_credit2;
    }

    public function view(): View
    {
        $data = $this->data;
        $bulan = $this->bulan;
        $tahun = $this->tahun;
        $sum_debit2 = $this->sum_debit2;
        $sum_credit2 = $this->sum_credit2;

        return view('lap_offline.reports.table_excel', ['data' => $data, 'bulan' => $bulan, 'tahun' => $tahun, 'sum_debit' => $sum_debit2, 'sum_credit' => $sum_credit2]);
    }

    public function title(): string
    {
        return 'laporan_offline';
    }


}
