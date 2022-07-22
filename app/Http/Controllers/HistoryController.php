<?php

namespace App\Http\Controllers;

use App\Exports\SalesExport;
use App\Model\reports;
use App\Model\SalesOrder;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HistoryController extends Controller
{
    public function history_index()
    {
        return view('history.show');
    }

    public function historyinvoiceshow()
    {
        $query = SalesOrder::where('published', '1')->where('printed', '1')->orderBy('created_at', 'desc');
        return Datatables::of(
            $query
        )->editColumn('nomor_invoice', function ($row) {
            return $row->nomor_invoice;
        })->editColumn('job_order_id', function ($row) {
            return $row->job_orders->order_id;
        })->editColumn('tipe', function ($row) {
            return $row->job_orders->tipe_order;
        })->editColumn('notes', function ($row) {
            return $row->notes;
        })->addColumn('More', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('history.dt.act_list_more', compact('data'));
        })->rawColumns(['action', 'More'])->toJson();
    }

    public function daily_home()
    {
        $month = array_reduce(range(1, 12), function ($rslt, $m) {
            $rslt[$m] = date('F', mktime(0, 0, 0, $m, 10));
            return $rslt;
        });
        return view('reports.daily', compact('month'));
    }

    public function export(Request $request)
    {
        $month = $request->month;
        $this->narikdata($month);
        $download = Excel::download(new SalesExport($month), 'ReportMonthly.xlsx');
        return $download;
    }

    public function narikdata($month)
    {
        reports::query()->truncate();
        $sum = 0;
        $tahun = Carbon::now()->format('Y');
        $sales = SalesOrder::whereMonth('created_at', $month)->whereYear('created_at', $tahun)
            ->where([
                ['printed', '=', '1'],
                ['published', '=', '1'],
            ])->get();
        foreach ($sales as $x) {
            $id = $x->id;
            if (empty($x->vat)) {
                $pajak = 0;
            } else {
                $pajak = $x->vat;
            }
            $no_inv = $x->nomor_invoice;
            $inv_date = $x->inv_date;
            $job_orders = $x->job_orders->order_id;
            if ($x->tipe == 'I') {
                $faktur = '-';
            } else {
                $faktur = 'DEBIT NOTE';
            }
            $sales_name = $x->sales->name;
            // $dop = '0000-00-00';
            $selling = SalesOrder::find($id)->sellings;
            foreach ($selling as $x) {
                $sub_total = $x->sub_total;
                $sum += $sub_total;
                $curr = $x->curr;
                $customer = $x->name;
            }
            // $pajak = Settings::where('name', 'Pajak')->first();
            // $nilai_pajak = $pajak->value;
            $pph = $sum * (2 / 100);
            $vat = $pajak / 100;
            $total_pajak = $sum * $vat;
            $total_charge = $sum + $total_pajak;
            $amount_ar = $total_charge - $pph;
            $payment = 0;
            $sales_usd = 0;
            $kurs_bi = 0;

            $reports = new reports;
            $reports->no_inv = $no_inv;
            $reports->inv_date = $inv_date;
            $reports->seri_faktur = $faktur;
            $reports->cust_name = $customer;
            $reports->nilai_inv = $sum;
            $reports->ppn = $total_pajak;
            $reports->grand_total = $total_charge;
            $reports->vat = $pajak;
            $reports->job_no = $job_orders;
            $reports->sales_name = $sales_name;
            // $reports->dop = $dop;
            $reports->pph = $pph;
            $reports->amount = $amount_ar;
            $reports->payment = $payment;
            $reports->AR = $amount_ar;
            $reports->sales_usd = $sales_usd;
            $reports->kurs_bi = $kurs_bi;
            $reports->save();
        }
    }
}