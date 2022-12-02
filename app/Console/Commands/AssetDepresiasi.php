<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
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

class AssetDepresiasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:AssetDepresiasi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Penambahan Otomatis Depresiasi Asset';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $ambil_data = Asset::all();

        foreach($ambil_data as $data){
            //cek apakah data barang_id ada
            if($data->barang_id == null){
                //tidak di eksekusi
            }else{
            //dieksekusi
            $barang = $data->barang->nama_barang;
            $barang_id = $data->barang_id;
            $elektronik = $data->barang->elektronik;

                $data_barang = nama_barang::where('elektronik' , $elektronik)->get();
                foreach($data_barang as $x){
                    $b = $x->elektronik;
                }

                    if($data->barang->elektronik){

                        if($data->coa->depresiasi == 1){

                            echo " EKSEKUSI ".$data->barang->nama_barang." ".$data->trans_date;
                                    $post = new Asset;
                                    $now = Carbon::parse($data->trans_date)->format('Y-m-d');
                                    $skrng = Carbon::now()->format('Y-m-d');
                                    $skrng_bulan = Carbon::parse($skrng)->format('m');
                                    $tahun = Carbon::parse($data->trans_date)->format('y');
                                    $bulan = Carbon::parse($data->trans_date)->format('m');

                                    //perhitungan
                                    $price = $data->ending_balance;
                                    $sekarang = Carbon::now()->format('Y-m-d');

                                    $s  = date_create($now);
                                    $d  = date_create($sekarang);

                                    $selisih_bulan = date_diff($s,$d);

                                    if($selisih_bulan->y >= 0){
                                        $tahun = $selisih_bulan->y * 12;
                                    }else{
                                        $tahun = 0;
                                    }

                                    $current_mount = $selisih_bulan->m + $tahun + 1;
                                    $depresiasai_mount = (25/100)/12;

                                    $hitung_depresiasai_mount = $depresiasai_mount * $current_mount;

                                    if($hitung_depresiasai_mount >= 1.0){
                                        $currentpriceafterdepresiasi = '-';
                                    }else{
                                        $currentpriceafterdepresiasi = $price - ($price * $hitung_depresiasai_mount);
                                    }


                                    $post->trans_date = $skrng;
                                    $post->induk_id = $data->id;
                                    $post->trans_no = $data->trans_no;
                                    $post->coa_id = '44';
                                    $post->bulan = $skrng_bulan;
                                    $post->sumber = 'ASSET';
                                    $post->barang_id = $data->barang_id;
                                    $post->debit = $currentpriceafterdepresiasi;
                                    $post->ending_balance = $currentpriceafterdepresiasi;
                                    $post->bs_pl = 'PL';
                                    $post->created_by = 'ROBOT';

                                    $post->save();

                                    $details_b = array(
                                        'trans_date' => $skrng,
                                        'induk_id' => $data->id,
                                        'trans_no' => $data->trans_no,
                                        'coa_id' => '15',
                                        'bulan' => $skrng_bulan,
                                        'sumber' => 'ASSET',
                                        'barang_id' => $data->barang_id,
                                        'credit' => $currentpriceafterdepresiasi,
                                        'ending_balance' => $currentpriceafterdepresiasi,
                                        'bs_pl' => 'BS',
                                        'created_by' => 'ROBOT'
                                    );

                                    Asset::insert($details_b);

                                    Log::info('Asset Deprisiasi dieksekusi!!!');

                        }else{
                            echo " | tidak di eksekusi | ";
                            Log::info('ada yang tidak di eksekusi');
                        }


                    }else{

                        echo " | INI NULL | ".$b." ";
                        Log::info('ada yg null');
                    }
            }

        }




    }
}
