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
    protected $start, $end, $data, $sum;

    function __construct($start, $end, $data, $sum)
    {
        $this->start = $start;
        $this->end = $end;
        $this->data = $data;
        $this->sum = $sum;


    }

    public function view(): View
    {
        $data = $this->data;
        $start = $this->start;
        $end = $this->end;
        $sum = $this->sum;



        return view('pos.reports.table_excel', ['data' => $data, 'start' => $start, 'end' => $end, 'sum' => $sum]);
    }

    public function title(): string
    {
        return 'laporan_transaksi_order';
    }


}
