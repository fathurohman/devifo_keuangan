<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\barangs;
use App\Model\order;
use App\Model\child_order;
use App\Model\lap_offline;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;
use Auth;
use Response;

class PosController extends Controller
{
    public function index()
    {
        return view('pos.index');
    }

    public function transaksi_index()
    {
        return view('pos.transaksi_index');
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
        })->addColumn('Status', function ($row) {
            $data = [
                'selesai' => $row->selesai,
            ];
            return view('pos.act.act_action', compact('data'));
        })->addColumn('More', function ($row) {
            $child = child_order::where('order_id', $row->id)->count();
            $data = [
                'id' => $row->id,
                'child' => $child
            ];
            return view('pos.act.act_more', compact('data'));
        })->rawColumns(['Status, More'])->toJson();
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
        $data->order_date = Carbon::now()->format('Y-m-d');
        $data->save();
        return redirect(route('pos.index'));
    }

    public function store_transaksi(Request $request)
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

        $datas = order::orderBy('id', 'desc')->first();

        return redirect(route('pos.order_index', $datas->id));
    }

    public function store_child(Request $request)
    {
        $data = new child_order;
        $data->order_id = $request->order_id;
        $data->barangs_id = $request->barangs_id;
        $data->jumlah = $request->jumlah;
        $data->date = Carbon::now()->format('Y-m-d');

        $barang = barangs::find($request->barangs_id);

        $data->total = $barang->harga_barang * $request->jumlah;

        if($request->jumlah > $barang->stock){

            session()->flash("error", "Stock tidak cukup");
            return redirect()->back()->with('success', 'Stock tidak cukup');

        }else{
            $stok_barang = $barang->stock - $request->jumlah;

            barangs::where('id', $request->barangs_id)->update(['stock' => $stok_barang]);

            // dd($stok_barang);

            $data->save();


            return redirect()->back();
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

    public function update_transfer(Request $request, $id)
    {
        $data = order::find($id);
        $data->selesai = '1';
        $data->bayar = 'transfer';
        $data->save();
        return redirect(route('pos.order_index', $id));
    }

    public function update_cash(Request $request, $id)
    {
        $data = order::find($id);
        $data->selesai = '1';
        $data->bayar = 'cash';
        $data->save();

        $co = child_order::where('order_id', $id)->get();

        foreach ($co as $i => $x) {
            $details = array(
                'name' => $request->name[$i],
                'keterangan' => 'transaksi order',
                'debit' => $request->debit[$i],
                'created_by' => Auth::user()->id,
                'order_id' => $request->order_id[$i],
                'date' => Carbon::now()->format('Y-m-d'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

            );
            lap_offline::insert($details);
        }




        return redirect(route('pos.order_index', $id));
    }

    public function update_batalstatus(Request $request, $id)
    {
        $data = order::find($id);
        $data->selesai = '0';
        $data->bayar = null;
        $data->save();

        lap_offline::where('order_id', $id)->delete();

        return redirect(route('pos.order_index', $id));
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



    public function reports()
    {
        return view('pos.reports.order_report');
    }

    public function get_rto(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        $data = order::whereBetween('order_date', [$start , $end])->get();
        // $sum = 0;
        // foreach($data as $c){
        //     $co = child_order::where('order_id', $c->id)->get();

        //     foreach($co as $x){

        //     $x->totals = $x->barangs->harga_barang * $x->jumlah;

        //     $sum_per_transaksi = $x->totals;
        //     $sum += $x->totals;

        //     }

        // }


        $html = view('pos.reports.table_reports')->with(compact('data'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function export_excel(Request $request)
    {

        $start = $request->start;
        $end = $request->end;
        $data = child_order::whereBetween('date', [$start , $end])->get();
        $sum = child_order::whereBetween('date', [$start , $end])->sum('total');

        // $sum = 0 ;
        // foreach ($data as $c) {

        //     $co = child_order::where('order_id', $c->id)->get();


        //     foreach ($co as $x) {

        //         $c->total = $x->total;
        //         $c->sum += $x->total;

        //         $c->nm_barang = $x->barangs->nama_barang;
        //         $c->hrg_barang = $x->barangs->harga_barang;
        //         $c->jumlah2 = $x->jumlah;

        //     }
        //     $c->totals = $c->sum;

        // }



        $download = Excel::download(new TransaksiExport($start, $end, $data, $sum), 'Transaksi_Order_'.$start.'_'.$end.'.xlsx');
        return $download;
    }
}
