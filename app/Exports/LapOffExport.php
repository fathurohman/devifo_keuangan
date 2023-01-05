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

    function __construct($bulan, $tahun, $data)
    {
        $this->bulan = $tahun;
        $this->tahun = $tahun;
        $this->data = $data;
    }

    public function view(): View
    {
        $data = $this->data;
        return view('lap_offline.reports.table_excel', ['data' => $data]);
    }

    public function title(): string
    {
        return 'laporan_offline';
    }


}
