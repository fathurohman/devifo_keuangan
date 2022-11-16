<?php

namespace App\Http\Controllers;

use App\Model\Jurnal;
use Illuminate\Http\Request;

class ProfitLossController extends Controller
{
    public function penjualan()
    {
        $sum_jual = 0;
        $penjualan = Jurnal::where('Chart_Of_Account', 'Penjualan')->get();
        foreach ($penjualan as $x) {
            $ending_balance = $x->ending_balance;
            $sum_jual += $ending_balance;
        }
        $data_jual = array(
            'Nama' => 'PENJUALAN',
            'total_penjualan' => $sum_jual,
        );
        return $data_jual;
    }

    public function hapok()
    {
        $sum_hapok = 0;
        $hapok = Jurnal::where('Chart_Of_Account', 'Harga Pokok Penjualan')->get();
        foreach ($hapok as $x) {
            $ending_balance = $x->ending_balance;
            $sum_hapok += $ending_balance;
        }
        $data_hapok = array(
            'Nama' => 'Harga Pokok Penjualan',
            'total_penjualan' => $sum_hapok,
        );
        return $data_hapok;
    }

    public function prof_loss()
    {
        $penjualan = $this->penjualan();
        $hapok = $this->hp_penjualan();
        dd($hapok);
        return view('jurnal.profloss.profloss', compact('penjualan'));
    }
}
