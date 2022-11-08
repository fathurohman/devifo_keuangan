<?php

namespace App\Http\Controllers;

use App\Model\COA;
use App\Model\jurnal_penjualan_bank;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class BankController extends Controller
{
    function numberToRomanRepresentation($number)
    {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    public function penerimaan()
    {
        $year = Carbon::now()->format('y');
        $month = Carbon::now()->format('m');
        $tahun = Carbon::now()->format('Y');
        $jml_by_month = jurnal_penjualan_bank::whereMonth('created_at', $month)->whereYear('created_at', $tahun)->count();
        $urutan = jurnal_penjualan_bank::select('order_row')->whereMonth('created_at', $month)->whereYear('created_at', $tahun)->get();
        $results = array();
        foreach ($urutan as $query) {
            $order_row = $query->order_row;
            array_push($results, $order_row);
        }
        if (empty($results)) {
            $max = 0;
        } else {
            $max = max($results);
        }
        if ($jml_by_month == '0') {
            $order_month = '1';
        } else {
            //ini ambil nilai max di kolom
            $order_month = $max + 1;
        }
        $sprint_order = sprintf('%03d', $order_month);
        // SGM/BCA IDR/IX/22/002
        $roman = $this->numberToRomanRepresentation($month);
        $order_id = "SGM/BCA IDR/$roman/$year/$sprint_order";
        return view('jurnal.bank.penerimaan_bank', compact('order_id'));
    }

    public function listcoa()
    {
        $query = COA::where('bank', '1');
        return Datatables::of(
            $query
        )->editColumn('kd_aktiva', function ($row) {
            return $row->kd_aktiva;
        })->editColumn('jns_trans', function ($row) {
            return $row->jns_trans;
        })->addColumn('Action', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('jurnal.dt.act_pilih', compact('data'));
        })->rawColumns(['action'])->toJson();
    }

    public function getdatacoa(Request $request)
    {
        $pid = $request->get('pid');
        $tipes = COA::where('id', $pid)->first();
        return Response::json($tipes);
    }

    public function autocomplete_coa(Request $request)
    {
        $term = $request->term;
        $queries = DB::table('jns_akun')
            ->where('jns_trans', 'LIKE', '%' . $term . '%')
            // ->where('rtk', '1')
            ->get();
        $results = array();
        foreach ($queries as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->jns_trans, 'kode' => $query->kd_aktiva];
        }
        return Response::json($results);
    }
}
