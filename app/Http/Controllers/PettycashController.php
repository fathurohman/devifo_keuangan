<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\COA;
use App\Model\jurnal_bank_child;
use App\Model\jurnal_bank;
use App\Model\pettycash;
use App\Model\nama_cash;
use App\Model\nama_barang;
use App\Model\Asset;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Auth;
use Response;

class PettycashController extends Controller
{
    public function index_pettycash()
    {
        return view('jurnal.bank.pettycash.show_pettycash');
    }

    public function create_pettycash()
    {
        return view('jurnal.bank.pettycash.create_pettycash');
    }

    public function store_pettycash(Request $request)
    {
        $i = 0;
        $now = Carbon::parse($request->Date)->format('Y-m-d');
        $tahun = Carbon::parse($request->Date)->format('y');
        $bulan = Carbon::parse($request->Date)->format('m');

        $query = pettycash::whereMonth('created_at', $bulan)->count();
        $urutan = $query + 1;

        $invoice = "SGM/KAS/" . $bulan . "/" . $tahun . "/" . $urutan;

        $data = new pettycash;
        $data->date = $now;
        $data->inv_no = $invoice;
        $data->description = $request->memo;
        $data->debit = $request->amount;
        $data->ending_balance = $request->total;
        $data->bs_pl = 'PL';
        $data->coa_id = $request->coa_id_pemasukan;
        $data->created_by = Auth::user()->id;

        if ($request->status_coa == 'pemasukan') {
            $data->dk = 'D';
        } elseif ($request->status_coa == 'pengeluaran') {
            $data->dk = 'K';
        } else {
            $data->dk = '-';
        }

        $data->save();

        $details_b = array(
            'date' => $now,
            'inv_no' => $invoice,
            'description' => $request->memo,
            'credit' => $request->amount,
            'ending_balance' => $request->total,
            'bs_pl' => 'BS',
            'coa_id' => 1,
            'dk' => 'K',
            'created_by' => 'ROBOT'

        );
        pettycash::insert($details_b);



        return redirect(route('pettycash'));
    }

    public function listpettycash()
    {

        $query = pettycash::where('created_by', '<>', 'ROBOT');
        return Datatables::of(
            $query
        )->editColumn('date', function ($row) {
            return $row->date;
        })->editColumn('inv_no', function ($row) {
            return $row->inv_no;
        })->editColumn('coa', function ($row) {
            return $row->coa->jns_trans;
        })->addColumn('More', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('jurnal.bank.pettycash.dt.act_more', compact('data'));
        })->rawColumns(['More'])->toJson();
    }

    public function showDetailPettyCash($id)
    {
        $data = pettycash::where('id', $id)->get();
        return view('jurnal.bank.pettycash.details_pettycash', compact('data'));
    }
}
