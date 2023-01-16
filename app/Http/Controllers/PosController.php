<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\barangs;
use App\Model\order;
use App\Model\child_order;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Auth;
use Response;

class PosController extends Controller
{
    public function index()
    {
        return view('pos.index');
    }

    public function order_index($id)
    {
        $order = order::find($id);
        $data = child_order::where('order_id', $id)->get();
        $barangs = barangs::all();
        return view('pos.order_index' , compact('data','order','barangs'));
    }

    public function listorder()
    {
        $query = order::all();
        return Datatables::of(
            $query
        )->editColumn('created_at', function ($row) {
            return Carbon::parse($row->created_at)->format('d-m-Y | H:i:s');
        })->editColumn('kode_nota', function ($row) {
            return $row->kode_nota;
        })->editColumn('nama_pembeli', function ($row) {
                return $row->nama_pembeli;
        })->editColumn('created_by', function ($row) {
            return $row->users->name;
        })->addColumn('Action', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('pos.act.act_action', compact('data'));
        })->addColumn('More', function ($row) {
            $data = [
                'id' => $row->id
            ];
            return view('pos.act.act_more', compact('data'));
        })->rawColumns(['Action, More'])->toJson();
    }

    public function create()
    {
        return view('pos.create');
    }

    public function store(Request $request)
    {
        $now = Carbon::now()->format('Y-m-d');
        $tahun = Carbon::now()->format('y');
        $bulan = Carbon::now()->format('m');
        $hari = Carbon::now()->format('d');

        $query = order::whereMonth('created_at', $bulan)->count();
        $urutan = $query + 1;

        $nota = "Nota/" . $hari . "/" . $bulan . "/" . $tahun . "/" . $urutan;


        $data = new order;
        $data->kode_nota = $nota;
        $data->nama_pembeli = $request->nama_pembeli;
        $data->no_pembeli = $request->no_pembeli;
        $data->created_by = Auth::user()->id;
        $data->save();
        return redirect(route('pos.index'));
    }

    public function store_child(Request $request)
    {
        $data = new child_order;
        $data->order_id = $request->order_id;
        $data->barangs_id = $request->barangs_id;
        $data->jumlah = $request->jumlah;
        $data->save();

        return redirect()->back();
    }

    public function delete_child($id)
    {
        child_order::where('id', $id)->delete();
        return redirect()->back();
    }
}
