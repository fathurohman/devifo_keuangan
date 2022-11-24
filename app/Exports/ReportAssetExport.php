<?php

namespace App\Exports;

use App\Model\Asset;
use App\Model\asset_spek;
use Carbon\Carbon;
use DateTime;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ReportAssetExport implements FromView, ShouldAutoSize, WithStrictNullComparison
{
    protected $from,$to;

    function __construct($from,$to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function view(): View
    {
        $from = $this->from;
        $to = $this->to;

        $data = Asset::whereBetween('trans_date', [$from, $to])->where('created_by', '<>', 'ROBOT')->get();

        return view('reports.asset', [
            'from' => $from,
            'to' => $to,
            'data' => $data
        ]);
    }
}
