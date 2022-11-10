<?php

namespace App\Http\Controllers;

use App\Model\COA;
use App\Model\jurnal_bank_child;
use App\Model\jurnal_bank;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class BankController extends Controller
{

    public function penerimaan()
    {
        return view('jurnal.bank.penerimaan_bank');
    }

    public function pengeluaran()
    {
        return view('jurnal.bank.pengeluaran_bank');
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

    public function store(Request $request)
    {
        $i = 0;
        $status = $request->status_coa_id;
        $now = Carbon::parse($request->Date)->format('Y-m-d');
        $jurnal = new jurnal_bank;
        if ($status == 'pengeluaran') {
            $jurnal->cheque_no = $request->cheque_no;
            $jurnal->payee = $request->payee;
            $dk = 'K';
            $jurnal->dk = $dk;
        } else {
            $dk = 'D';
            $jurnal->dk = $dk;
        }
        $jurnal->trans_date = $now;
        $jurnal->inv_no = $request->voucher_no;
        $jurnal->description = $request->memo;
        $jurnal->coa_id = $request->coa_id;
        $jurnal->debit = $request->amount;
        $jurnal->ending_balance = $request->total;
        $jurnal->kurs_rupiah = $request->kurs_idr;
        $jurnal->bs_pl = 'BS';
        $jurnal->save();
        if (!empty($request->account_id[0])) {
            foreach ($request->account_id as $a => $v) {
                $details_b = array(
                    'jurnal_bank_id' => $jurnal->id,
                    'trans_date' => $now,
                    'inv_no' => $request->voucher_no,
                    'description' => $request->memo[$a],
                    'coa_id' => $v,
                    'debit' => $request->amount_c[$a],
                    'project' => $request->project[$a],
                    'dk' => $dk,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                );
                jurnal_bank_child::insert($details_b);
                $i++;
            }
        }
    }
}
