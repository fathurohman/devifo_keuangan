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
    //-------------------------------aktiva lancar -----------------------------------------
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

    public function dimuka_gedung()
    {
        $sum_dimuka_gedung = 0;
        $dimuka_gedung = Jurnal::where('Chart_Of_Account', 'Sewa Dibayar dimuka - Gedung')->where('bs_pl', 'BS')->get();
        foreach ($dimuka_gedung as $x) {
            $ending_balance = $x->ending_balance;
            $sum_dimuka_gedung += $ending_balance;
        }
        $data_dimuka_gedung = array(
            'Nama' => 'Sewa Dibayar dimuka - Gedung',
            'total_dimuka_gedung' => $sum_dimuka_gedung,
        );
        return $data_dimuka_gedung;
    }

    public function jumlah_aktiva_kas()
    {
        $piutang_dagang = $this->piutang_dagang();
        $piutang_saham = $this->piutang_saham();
        $dp_pembelian = $this->dp_pembelian();
        $dp_karyawan = $this->dp_karyawan();
        $dp_pph = $this->dp_pph();
        $dimuka_gedung = $this->dimuka_gedung();
        $jumlah_cash = ($piutang_dagang['total_piutang_dagang'] + $piutang_saham['total_piutang_saham'] + $dp_pembelian['total_dp_pembelian']
            + $dp_karyawan['total_dp_karyawan'] + $dp_pph['total_dp_pph'] + $dimuka_gedung['total_dimuka_gedung']);
        return $jumlah_cash;
    }
    //----------------aktiva lancar-------------------------------------------
    public function peralatan_kerja()
    {
        $sum_peralatan_kerja = 0;
        $peralatan_kerja = Jurnal::where('Chart_Of_Account', 'Aktiva JakA/Rta - Peralatan Kerja')->where('bs_pl', 'BS')->get();
        foreach ($peralatan_kerja as $x) {
            $ending_balance = $x->ending_balance;
            $sum_peralatan_kerja += $ending_balance;
        }
        $data_peralatan_kerja = array(
            'Nama' => 'Aktiva Jakarta - Peralatan Kerja',
            'total_peralatan_kerja' => $sum_peralatan_kerja,
        );
        return $data_peralatan_kerja;
    }

    public function penyusutan_peralatan_kerja()
    {
        $sum_penyusutan_peralatan_kerja = 0;
        $penyusutan_peralatan_kerja = Jurnal::where('Chart_Of_Account', 'Akumulasi Penyusutan JakA/Rta - Peralatan Kerja')->where('bs_pl', 'BS')->get();
        foreach ($penyusutan_peralatan_kerja as $x) {
            $ending_balance = $x->ending_balance;
            $sum_penyusutan_peralatan_kerja += $ending_balance;
        }
        $data_penyusutan_peralatan_kerja = array(
            'Nama' => 'Akumulasi Penyusutan - Peralatan Kerja',
            'total_penyusutan_peralatan_kerja' => $sum_penyusutan_peralatan_kerja,
        );
        return $data_penyusutan_peralatan_kerja;
    }

    public function jumlah_aktiva_tetap()
    {
        $peralatan_kerja = $this->peralatan_kerja();
        $penyusutan_peralatan_kerja = $this->penyusutan_peralatan_kerja();
        $jumlah_cash = ($peralatan_kerja['total_peralatan_kerja'] + $penyusutan_peralatan_kerja['total_penyusutan_peralatan_kerja']);
        return $jumlah_cash;
    }

    //-----------------------Total aktiva-----------------------------------------------

    public function total_aktiva()
    {
        $peralatan_kerja = $this->peralatan_kerja();
        $jumlah_aktiva_tetap = $this->jumlah_aktiva_tetap();
        $jumlah_cash = ($peralatan_kerja['total_peralatan_kerja'] + $jumlah_aktiva_tetap['total_penyusutan_peralatan_kerja']);
        return $jumlah_cash;
    }


    public function neraca()
    {
        $bca_idr = $this->BCA_IDR();
        return view('jurnal.neraca.neraca');
    }
}
