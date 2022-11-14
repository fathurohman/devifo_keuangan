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

class AssetController extends Controller
{
    public function index_assets()
    {
        return view('jurnal.bank.asset.show_asset');
    }

    public function create_assets()
    {

        $data = nama_barang::where('aktif', 'Y')->get();
        return view('jurnal.bank.asset.create_asset',compact('data'));
    }

    public function listasset()
    {

        $query = Asset::all();
        return Datatables::of(
            $query
        )->editColumn('trans_date', function ($row) {
            return $row->trans_date;
        })->editColumn('trans_no', function ($row) {
            return $row->trans_no;
        })->editColumn('nama_barang', function ($row) {
            return $row->barang->nama_barang;
        })->editColumn('coa', function ($row) {
            return $row->coa->jns_trans;
        })->addColumn('More', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('jurnal.bank.asset.dt.act_more', compact('data'));
        })->rawColumns(['More'])->toJson();
    }

    public function store_asset(Request $request)
    {
        $i = 0;
        $now = Carbon::parse($request->Date)->format('Y-m-d');
        $tahun = Carbon::parse($request->Date)->format('y');
        $bulan = Carbon::parse($request->Date)->format('m');

        $data = new Asset;
        $data->trans_date = $now;
        $data->coa_id = $request->coa_id;
        $data->bulan = $bulan;
        $data->sumber = 'ASSET';
        $data->barang_id = $request->id_barang;
        $data->description = $request->memo;
        $data->debit = $request->amount;
        $data->ending_balance = $request->total;
        $data->bs_pl = 'BS';

        $data->save();

        return redirect(route('asset'));
    }

    public function listnamabarang(){

        $query = nama_barang::where('aktif' , 'Y');
        return Datatables::of(
            $query
        )->editColumn('nama_barang', function ($row) {
            return $row->nama_barang;
        })->addColumn('Action', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('jurnal.bank.asset.dt.act_pilih', compact('data'));
        })->rawColumns(['action'])->toJson();

    }

    public function getdatabarang(Request $request)
    {
        $pid = $request->get('pid');
        $tipes = nama_barang::where('id', $pid)->first();
        return Response::json($tipes);
    }

    public function showDetailAsset($id)
    {
        $data = Asset::where('id', $id)->get();
        return view('jurnal.bank.asset.detail_asset', compact('data'));
    }
}
