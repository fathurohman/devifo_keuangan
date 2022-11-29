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
use App\Model\assets_spek;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Exports\ReportAssetExport;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use Auth;

class AssetController extends Controller
{
    public function index_assets()
    {

        return view('jurnal.bank.asset.show_asset');
    }



    public function edit_assets($id)
    {
        $data = assets_spek::where('assets_id',$id)->firstOrFail();

        return view('jurnal.bank.asset.edit_assets', compact('data'));
    }

    public function add_assets_spek($id)
    {
        $data = Asset::find($id);
        return view('jurnal.bank.asset.add_asset_spek', compact('data'));
    }

    public function add_assets(Request $request)
    {

        $data = new assets_spek;
        $data->assets_id = $request->assets_id;
        $data->nama = $request->nama;
        $data->detail = $request->detail;
        $data->penggunaan = $request->penggunaan;
        $data->save();

        return redirect(route('asset'));
    }

    public function update_assets(Request $request, $id)
    {

        $data = assets_spek::find($id);
        $data->assets_id = $request->assets_id;
        $data->nama = $request->nama;
        $data->detail = $request->detail;
        $data->penggunaan = $request->penggunaan;
        $data->save();

        return redirect(route('asset'));
    }

    public function create_assets()
    {

        $data = nama_barang::where('aktif', 'Y')->get();
        return view('jurnal.bank.asset.create_asset',compact('data'));
    }

    public function listasset()
    {


        $query = Asset::where('created_by', '<>' , 'ROBOT');
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
            $cek_spek = assets_spek::where('assets_id',$row->id )->count();

            if($cek_spek == 1){

                return view('jurnal.bank.asset.dt.act_more2', compact('data'));

            }else{

                return view('jurnal.bank.asset.dt.act_more', compact('data'));

            }


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
        $data->trans_no = $request->voucher_no;
        $data->sumber = 'ASSET';
        $data->barang_id = $request->id_barang;
        $data->description = $request->memo;
        $data->debit = $request->amount;
        $data->ending_balance = $request->total;
        $data->bs_pl = 'BS';
        $data->created_by = Auth::user()->id;

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
        $spek = assets_spek::where('assets_id', $id)->get();
        return view('jurnal.bank.asset.detail_asset', compact('data','spek'));
    }


    public function create_asset_penyusutan()
    {
        // $price =  2950000 ;
        // $current_mount = 0;
        // $depresiasai_mount = (25/100)/12;

        // $hitung_depresiasai_mount = $depresiasai_mount * $current_mount;
        // echo $hitung_depresiasai_mount;
        // if($hitung_depresiasai_mount >= 1.0){
        //     echo 'lebih dari 100%';
        // }else{
        //     echo 'kurang dari 100%';
        //     $currentpriceafterdepresiasi = $price - ($price * $hitung_depresiasai_mount);

        //     echo $currentpriceafterdepresiasi;
        // }

        // // dd($depresiasai_mount);

        // $ambil_data = Asset::all();

        // foreach($ambil_data as $data){
        //     $barang = $data->barang->nama_barang;
        //     $barang_id = $data->barang_id;
        //     $elektronik = $data->barang->elektronik;

        //         $data_barang = nama_barang::where('elektronik' , $elektronik)->get();
        //         foreach($data_barang as $x){
        //             $b = $x->elektronik;
        //         }

        //             if($data->barang->elektronik){

        //                 if($data->coa_id == '109' || $data->coa_id == '90'){

        //                     echo " EKSEKUSI ".$data->barang->nama_barang." ".$data->trans_date;

        //                 }else{
        //                     echo " | tidak di eksekusi | ";
        //                 }


        //             }else{

        //                 echo " | INI NULL | ".$b." ";
        //             }


        // }


        $hari_ini = Carbon::now()->format('Y-m-d');
        $tgl_akhir = Date('Y-m-t', strtotime($hari_ini));

        $now = Carbon::parse($hari_ini)->format('Y-m-d');

        $s  = date_create('1995-11-01');
        $d  = date_create($now);

        $selisih_bulan = date_diff($s,$d);
        if($selisih_bulan->y >= 0){
            $tahun = $selisih_bulan->y * 12;
        }else{
            $tahun = 0;
        }
        $hitung = $selisih_bulan->m + $tahun + 1;

        dd($hitung);


        // $data = nama_barang::where('aktif', 'Y')->get();
        // return view('jurnal.bank.asset.assets_penyusutan',compact('data'));
    }

    public function store_penyusutan(Request $request)
    {
        $data = new Asset;

        $now = Carbon::parse($request->Date)->format('Y-m-d');
        $tahun = Carbon::parse($request->Date)->format('y');
        $bulan = Carbon::parse($request->Date)->format('m');

        //perhitungan
        $price = $request->amount;
        $sekarang = Carbon::now()->format('Y-m-d');

        $s  = date_create($now);
        $d  = date_create($sekarang);

        $selisih_bulan = date_diff($s,$d);

        $current_mount = $selisih_bulan->m;
        $depresiasai_mount = (25/100)/12;

        $hitung_depresiasai_mount = $depresiasai_mount * $current_mount;

        if($hitung_depresiasai_mount >= 1.0){
            $currentpriceafterdepresiasi = '-';
        }else{
            $currentpriceafterdepresiasi = $price - ($price * $hitung_depresiasai_mount);
        }


        $data->trans_date = $now;
        $data->coa_id = '44';
        $data->bulan = $bulan;
        $data->sumber = 'ASSET';
        $data->barang_id = $request->id_barang;
        $data->debit = $currentpriceafterdepresiasi;
        $data->ending_balance = $currentpriceafterdepresiasi;
        $data->bs_pl = 'PL';

        $data->save();

        $details_b = array(
            'trans_date' => $now,
            'coa_id' => 15,
            'bulan' => $bulan,
            'sumber' => 'ASSET',
            'barang_id' => '',
            'credit' => $currentpriceafterdepresiasi,
            'ending_balance' => $currentpriceafterdepresiasi,
            'bs_pl' => 'BS',


        );
        Asset::insert($details_b);

        return redirect(route('asset'));
    }


    public function report_assets()
    {
        $data = Asset::where('created_by', '<>' , 'ROBOT');
        return view('jurnal.bank.asset.report_assets', compact('data'));
    }

    public function report_listasset()
    {

        $query = Asset::where('created_by', '<>' , 'ROBOT');
        return Datatables::of(
            $query
        )->editColumn('trans_date', function ($row) {
            return $row->trans_date;
        })->editColumn('nama_barang', function ($row) {
            return $row->barang->nama_barang;
        })->editColumn('harga_barang', function ($row) {
            return number_format((float) $row->debit, 2, '.', ',');
        })->addColumn('More', function ($row) {
            $data = [
                'id' => $row->id,
                'elektronik' => $row->barang->elektronik
            ];

        return view('jurnal.bank.asset.dt.act_more_report', compact('data'));


        })->rawColumns(['More'])->toJson();
    }

    public function showDetailSpek($id)
    {
        $spek = assets_spek::where('assets_id', $id)->get();
        return view('jurnal.bank.asset.detail_report_asset', compact('spek'));
    }
    public function showDetailDes($id)
    {
        $data = Asset::where('id', $id)->get();
        $des = Asset::where('induk_id', $id)->where('coa_id', '44')->get();
        return view('jurnal.bank.asset.detail_report_despresiasi', compact('data','des'));
    }

    public function export_report_asset(Request $request)
    {
        $from = $request->start;
        $to = $request->end;
        $download = Excel::download(new ReportAssetExport($from, $to), 'ReportAsset.xlsx');
        return $download;
    }


}
