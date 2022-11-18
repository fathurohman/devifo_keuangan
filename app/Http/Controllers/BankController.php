<?php

namespace App\Http\Controllers;

use App\Model\COA;
use App\Model\jurnal_bank_child;
use App\Model\jurnal_bank;
use App\Model\pettycash;
use App\Model\nama_cash;
use App\Model\nama_barang;
use App\Model\Asset;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class BankController extends Controller
{

    public function index()
    {
        return view('jurnal.bank.jurnal_bank');
    }

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
        $query = COA::all();
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

    public function listcoa_pemasukan()
    {
        $query = COA::all();
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
            return view('jurnal.bank.pettycash.listcoa.act_pilih_pemasukan', compact('data'));
        })->rawColumns(['action'])->toJson();
    }

    public function listcoa_pengeluaran()
    {
        $query = COA::all();
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
            return view('jurnal.bank.pettycash.listcoa.act_pilih_pengeluaran', compact('data'));
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
            ->where('induk', 'T')
            ->where('aktif', 'Y')
            // ->orWhere('neraca', '1')
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
        $coa_id = $request->coa_id;
        $coa = COA::find($coa_id);
        $neraca = $coa->neraca;
        $laba_rugi = $coa->laba_rugi;
        if ($neraca == '1') {
            $bs_pl = 'BS';
        } elseif ($laba_rugi == '1') {
            $bs_pl = 'PL';
        } else {
            $bs_pl = 'unk';
        }
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
        $jurnal->coa_id = $coa_id;
        $jurnal->debit = $request->amount;
        $jurnal->ending_balance = $request->total;
        $jurnal->kurs_rupiah = $request->kurs_idr;
        $jurnal->bs_pl = $bs_pl;
        $jurnal->save();
        if (!empty($request->account_id[0])) {
            foreach ($request->account_id as $a => $v) {
                $acc = COA::find($v);
                $neraca = $acc->neraca;
                $laba_rugi = $acc->laba_rugi;
                if ($neraca == '1') {
                    $bs_pl = 'BS';
                } elseif ($laba_rugi == '1') {
                    $bs_pl = 'PL';
                } else {
                    $bs_pl = 'unk';
                }
                $details_b = array(
                    'jurnal_bank_id' => $jurnal->id,
                    'trans_date' => $now,
                    'inv_no' => $request->voucher_no,
                    'description' => $request->memo[$a],
                    'coa_id' => $v,
                    'debit' => $request->amount_c[$a],
                    'ending_balance' => $request->amount_c[$a],
                    'project' => $request->project[$a],
                    'dk' => $dk,
                    'bs_pl' => $bs_pl,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                );
                jurnal_bank_child::insert($details_b);
                $i++;
            }
        }

        return redirect(route('jurnal_bank'));
    }


    public function listjurnalbank()
    {

        $query = jurnal_bank::all();
        return Datatables::of(
            $query
        )->editColumn('trans_date', function ($row) {
            return $row->trans_date;
        })->editColumn('inv_no', function ($row) {
            return $row->inv_no;
        })->editColumn('cheque_no', function ($row) {
            return $row->cheque_no;
        })->editColumn('coa', function ($row) {
            return $row->coa->jns_trans;
        })->addColumn('More', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('jurnal.bank.dt_bank.act_more', compact('data'));
        })->rawColumns(['More'])->toJson();
    }

    public function showDetailJurnalBank($id)
    {
        $data = jurnal_bank::where('id', $id)->get();
        return view('jurnal.bank.details_jb', compact('data'));
    }

    public function showChildJurnalBank($id)
    {
        $data = jurnal_bank_child::where('jurnal_bank_id', $id)->get();
        return view('jurnal.bank.child_jb', compact('data'));
    }
}
