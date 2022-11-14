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

    public function hp_penjualan()
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

    public function prof_loss()
    {
        $penjualan = $this->penjualan();
        dd($penjualan);
        return view('jurnal.profloss.profloss', compact('penjualan'));
    }
}
