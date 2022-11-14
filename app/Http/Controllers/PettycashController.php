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
use Response;

class PettycashController extends Controller
{
    public function index_pettycash()
    {
        return view('jurnal.bank.pettycash.show_pettycash');
    }

    public function create_pettycash()
    {

        $data = nama_cash::where('aktif', 'Y')->get();
        return view('jurnal.bank.pettycash.create_pettycash', compact('data'));
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

        if ($request->status_coa == 'pemasukan') {
            $data->dk = 'D';
            $data->untuk_kas = $request->untuk_kas;
            $data->coa_id = $request->coa_id_pemasukan;
        } elseif ($request->status_coa == 'pengeluaran') {
            $data->dk = 'K';
            $data->dari_kas = $request->dari_kas;
            $data->coa_id = $request->coa_id_pengeluaran;
        } else {
            $data->dk = '-';
            $data->dari_kas = '-';
            $data->coa_id = '-';
        }

        $data->save();

        $details_b = array(
            'date' => $now,
            'inv_no' => $invoice,
            'description' => $request->memo,
            'credit' => $request->amount,
            'ending_balance' => $request->total,
            'bs_pl' => 'BS',
            'coa_id' => 7,
            'dk' => 'K'

        );
        pettycash::insert($details_b);



        return redirect(route('pettycash'));
    }

    public function listpettycash()
    {

        $query = pettycash::all();
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
