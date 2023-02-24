<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithTitle;

class TransaksiExport implements FromView, ShouldAutoSize, WithStrictNullComparison, WithTitle
{
    protected $start, $end, $data;

    function __construct($start, $end, $data)
    {
        $this->start = $start;
        $this->end = $end;
        $this->data = $data;

    }

    public function view(): View
    {
        $data = $this->data;
        $start = $this->start;
        $end = $this->end;


        return view('pos.reports.table_excel', ['data' => $data, 'start' => $start, 'end' => $end]);
    }

    public function title(): string
    {
        return 'laporan_transaksi_order';
    }


}
