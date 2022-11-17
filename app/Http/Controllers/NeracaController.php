<?php

namespace App\Http\Controllers;

use App\Model\Jurnal;
use Illuminate\Http\Request;

class NeracaController extends Controller
{
    public function BCA_IDR()
    {
        $sum_bca_idr = 0;
        $bca_idr = Jurnal::where('Chart_Of_Account', 'BCA - IDR XXX (NON PPN)')->where('bs_pl', 'BS')->get();
        foreach ($bca_idr as $x) {
            $ending_balance = $x->ending_balance;
            $sum_bca_idr += $ending_balance;
        }
        $data_bca_idr = array(
            'Nama' => 'BCA SIGMA IDR',
            'total_bca_idr' => $sum_bca_idr,
        );
        return $data_bca_idr;
    }

    public function BCA_USD()
    {
        $sum_bca_usd = 0;
        $bca_usd = Jurnal::where('Chart_Of_Account', 'BCA - USD')->where('bs_pl', 'BS')->get();
        foreach ($bca_usd as $x) {
            $ending_balance = $x->ending_balance;
            $sum_bca_usd += $ending_balance;
        }
        $data_bca_usd = array(
            'Nama' => 'BCA SIGMA USD',
            'total_bca_usd' => $sum_bca_usd,
        );
        return $data_bca_usd;
    }

    public function kas_kecil()
    {
        $sum_kas_kecil = 0;
        $kas_kecil = Jurnal::where('Chart_Of_Account', 'Kas Kecil Kantor Pusat - IDR')->where('bs_pl', 'BS')->get();
        foreach ($kas_kecil as $x) {
            $ending_balance = $x->ending_balance;
            $sum_kas_kecil += $ending_balance;
        }
        $data_kas_kecil = array(
            'Nama' => 'BCA SIGMA USD',
            'total_kas_kecil' => $sum_kas_kecil,
        );
        return $data_kas_kecil;
    }

    public function jumlah_kas()
    {
        $bca_idr = $this->BCA_IDR();
        $bca_usd = $this->BCA_USD();
        $kas_kecil = $this->kas_kecil();
        $jumlah_cash = ($bca_idr['total_bca_idr'] + $bca_usd['total_bca_usd'] + $kas_kecil['total_kas_kecil']);
        return $jumlah_cash;
    }

    public function piutang_dagang()
    {
        $sum_piutang_dagang = 0;
        $piutang_dagang = Jurnal::where('Chart_Of_Account', 'Piutang Dagang - IDR')->where('bs_pl', 'BS')->get();
        foreach ($piutang_dagang as $x) {
            $ending_balance = $x->ending_balance;
            $sum_piutang_dagang += $ending_balance;
        }
        $data_piutang_dagang = array(
            'Nama' => 'Piutang Dagang - IDR',
            'total_piutang_dagang' => $sum_piutang_dagang,
        );
        return $data_piutang_dagang;
    }

    public function piutang_saham()
    {
        $sum_piutang_saham = 0;
        $piutang_saham = Jurnal::where('Chart_Of_Account', 'PIUTANG PEMEGANG SAHAM')->where('bs_pl', 'BS')->get();
        foreach ($piutang_saham as $x) {
            $ending_balance = $x->ending_balance;
            $sum_piutang_saham += $ending_balance;
        }
        $data_piutang_saham = array(
            'Nama' => 'Piutang Pemegang Saham',
            'total_piutang_saham' => $sum_piutang_saham,
        );
        return $data_piutang_saham;
    }

    public function dp_pembelian()
    {
        $sum_dp_pembelian = 0;
        $dp_pembelian = Jurnal::where('Chart_Of_Account', 'Uang Muka Pembelian - IDR')->where('bs_pl', 'BS')->get();
        foreach ($dp_pembelian as $x) {
            $ending_balance = $x->ending_balance;
            $sum_dp_pembelian += $ending_balance;
        }
        $data_dp_pembelian = array(
            'Nama' => 'Uang Muka Pembelian',
            'total_dp_pembelian' => $sum_dp_pembelian,
        );
        return $data_dp_pembelian;
    }

    public function dp_karyawan()
    {
        $sum_dp_karyawan = 0;
        $dp_karyawan = Jurnal::where('Chart_Of_Account', 'Uang Muka Kerja Karyawan - IDR')->where('bs_pl', 'BS')->get();
        foreach ($dp_karyawan as $x) {
            $ending_balance = $x->ending_balance;
            $sum_dp_karyawan += $ending_balance;
        }
        $data_dp_karyawan = array(
            'Nama' => 'Uang Muka Kerja Karyawan - IDR',
            'total_dp_karyawan' => $sum_dp_karyawan,
        );
        return $data_dp_karyawan;
    }

    public function dp_pph()
    {
        $sum_dp_pph = 0;
        $dp_pph = Jurnal::where('Chart_Of_Account', 'Pajak Dibayar Dimuka - PPH 23')->where('bs_pl', 'BS')->get();
        foreach ($dp_pph as $x) {
            $ending_balance = $x->ending_balance;
            $sum_dp_pph += $ending_balance;
        }
        $data_dp_pph = array(
            'Nama' => 'Pajak Dibayar Dimuka - PPH 23',
            'total_dp_pph' => $sum_dp_pph,
        );
        return $data_dp_pph;
    }

    public function neraca()
    {
        $bca_idr = $this->BCA_IDR();
        return view('jurnal.neraca.neraca');
    }
}
