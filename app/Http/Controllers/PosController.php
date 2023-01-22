<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\barangs;
use App\Model\order;
use App\Model\child_order;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
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
        $sum = 0;
        foreach($data as $x){
            $x->total = $x->barangs->harga_barang * $x->jumlah;
            $sum += $x->total;
        }
        $barangs = barangs::all();
        return view('pos.order_index' , compact('data','order','barangs','sum'));
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
        // })->editColumn('created_by', function ($row) {
        //     return $row->users->name;
        })->addColumn('Action', function ($row) {
            $child = child_order::where('order_id', $row->id)->count();
            $data = [
                'id' => $row->id,
                'child' => $child
            ];
            return view('pos.act.act_action', compact('data'));
        })->addColumn('More', function ($row) {
            $child = child_order::where('order_id', $row->id)->count();
            $data = [
                'id' => $row->id,
                'child' => $child
            ];
            return view('pos.act.act_more', compact('data'));
        })->rawColumns(['Action, More'])->toJson();
    }

    public function detail($id)
    {
        $order = order::find($id);
        $data = child_order::where('order_id', $id)->get();
        $sum = 0;
        foreach($data as $x){
            $x->total = $x->barangs->harga_barang * $x->jumlah;
            $sum += $x->total;
        }
        $barangs = barangs::all();

        return view('pos.detail', compact('data','order','barangs','sum'));
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

        $barang = barangs::find($request->barangs_id);

        if($request->jumlah > $barang->stock){

            session()->flash("error", "Stock tidak cukup");
            return redirect()->back()->with('success', 'Stock tidak cukup');

        }else{
            $stok_barang = $barang->stock - $request->jumlah;

            barangs::where('id', $request->barangs_id)->update(['stock' => $stok_barang]);

            // dd($stok_barang);

            $data->save();

            session()->flash("success", "Berhasil di tambahkan");
            return redirect()->back()->with('success', 'Berhasil di tambahkan');
        }

    }

    public function edit($id)
    {
        $data = order::find($id);
        return view('pos.edit' , compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = order::find($id);
        $data->nama_pembeli = $request->nama_pembeli;
        $data->no_pembeli = $request->no_pembeli;
        $data->save();
        return redirect(route('pos.index'));
    }

    public function delete($id)
    {
        order::where('id', $id)->delete();

        return redirect()->back();
    }

    public function delete_child($id)
    {

        $data = child_order::find($id);
        $barang = barangs::find($data->barangs_id);
        $restore = $data->jumlah + $barang->stock;

        barangs::where('id', $data->barangs_id)->update(['stock' => $restore]);

        child_order::where('id', $id)->delete();

        return redirect()->back();
    }

    public function print($id)
    {
        $order = order::find($id);
        $data = child_order::where('order_id', $id)->get();
        $sum = 0;
        foreach($data as $x){
            $x->total = $x->barangs->harga_barang * $x->jumlah;
            $sum += $x->total;
        }
        $barangs = barangs::all();
        $data = array(
            'data' => $data,
            'order' => $order,
            'barangs' => $barangs,
            'sum' => $sum
        );

        $view = View('pdf.order_pdf', ['data' => $data]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render())->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
}
