<?php

namespace App\Http\Controllers;

use App\Model\Jurnal;
use Illuminate\Http\Request;

class NeracaController extends Controller
{
    public function BCA_IDR()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_bca_idr = 0;
        $bca_idr = Jurnal::where('Chart_Of_Account', 'BCA - IDR XXX (NON PPN)')->where('bs_pl', 'BS')->get();
        foreach ($bca_idr as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_bca_idr = $sum_debit - $sum_credit;
        }
        $data_bca_idr = array(
            'Nama' => 'BCA SIGMA IDR',
            'total_bca_idr' => $sum_bca_idr,
        );
        return $data_bca_idr;
    }

    public function BCA_USD()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_bca_usd = 0;
        $bca_usd = Jurnal::where('Chart_Of_Account', 'BCA - USD')->where('bs_pl', 'BS')->get();
        foreach ($bca_usd as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_bca_usd = $sum_debit - $sum_credit;
        }
        $data_bca_usd = array(
            'Nama' => 'BCA SIGMA USD',
            'total_bca_usd' => $sum_bca_usd,
        );
        return $data_bca_usd;
    }

    public function kas_kecil()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_kas_kecil = 0;
        $kas_kecil = Jurnal::where('Chart_Of_Account', 'Kas Kecil Kantor Pusat - IDR')->where('bs_pl', 'BS')->get();
        foreach ($kas_kecil as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_kas_kecil = $sum_debit - $sum_credit;
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
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_piutang_dagang = 0;
        $piutang_dagang = Jurnal::where('Chart_Of_Account', 'Piutang Dagang - IDR')->where('bs_pl', 'BS')->get();
        foreach ($piutang_dagang as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_piutang_dagang = $sum_debit - $sum_credit;
        }
        $data_piutang_dagang = array(
            'Nama' => 'Piutang Dagang - IDR',
            'total_piutang_dagang' => $sum_piutang_dagang,
        );
        return $data_piutang_dagang;
    }

    public function piutang_saham()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_piutang_saham = 0;
        $piutang_saham = Jurnal::where('Chart_Of_Account', 'PIUTANG PEMEGANG SAHAM')->where('bs_pl', 'BS')->get();
        foreach ($piutang_saham as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_piutang_saham = $sum_debit - $sum_credit;
        }
        $data_piutang_saham = array(
            'Nama' => 'Piutang Pemegang Saham',
            'total_piutang_saham' => $sum_piutang_saham,
        );
        return $data_piutang_saham;
    }

    public function dp_pembelian()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_dp_pembelian = 0;
        $dp_pembelian = Jurnal::where('Chart_Of_Account', 'Uang Muka Pembelian - IDR')->where('bs_pl', 'BS')->get();
        foreach ($dp_pembelian as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_dp_pembelian = $sum_debit - $sum_credit;
        }
        $data_dp_pembelian = array(
            'Nama' => 'Uang Muka Pembelian',
            'total_dp_pembelian' => $sum_dp_pembelian,
        );
        return $data_dp_pembelian;
    }

    public function dp_karyawan()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_dp_karyawan = 0;
        $dp_karyawan = Jurnal::where('Chart_Of_Account', 'Uang Muka Kerja Karyawan - IDR')->where('bs_pl', 'BS')->get();
        foreach ($dp_karyawan as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_dp_karyawan = $sum_debit - $sum_credit;
        }
        $data_dp_karyawan = array(
            'Nama' => 'Uang Muka Kerja Karyawan - IDR',
            'total_dp_karyawan' => $sum_dp_karyawan,
        );
        return $data_dp_karyawan;
    }

    public function dp_pph()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_dp_pph = 0;
        $dp_pph = Jurnal::where('Chart_Of_Account', 'Pajak Dibayar Dimuka - PPH 23')->where('bs_pl', 'BS')->get();
        foreach ($dp_pph as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_dp_pph = $sum_debit - $sum_credit;
        }
        $data_dp_pph = array(
            'Nama' => 'Pajak Dibayar Dimuka - PPH 23',
            'total_dp_pph' => $sum_dp_pph,
        );
        return $data_dp_pph;
    }

    public function dimuka_gedung()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_dimuka_gedung = 0;
        $dimuka_gedung = Jurnal::where('Chart_Of_Account', 'Sewa Dibayar dimuka - Gedung')->where('bs_pl', 'BS')->get();
        foreach ($dimuka_gedung as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_dimuka_gedung = $sum_debit - $sum_credit;
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
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_peralatan_kerja = 0;
        $peralatan_kerja = Jurnal::where('Chart_Of_Account', 'Aktiva JakA/Rta - Peralatan Kerja')->where('bs_pl', 'BS')->get();
        foreach ($peralatan_kerja as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_peralatan_kerja = $sum_debit - $sum_credit;
        }
        $data_peralatan_kerja = array(
            'Nama' => 'Aktiva Jakarta - Peralatan Kerja',
            'total_peralatan_kerja' => $sum_peralatan_kerja,
        );
        return $data_peralatan_kerja;
    }

    public function penyusutan_peralatan_kerja()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_penyusutan_peralatan_kerja = 0;
        $penyusutan_peralatan_kerja = Jurnal::where('Chart_Of_Account', 'Akumulasi Penyusutan JakA/Rta - Peralatan Kerja')->where('bs_pl', 'BS')->get();
        foreach ($penyusutan_peralatan_kerja as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_penyusutan_peralatan_kerja = $sum_debit - $sum_credit;
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

    public function total_aktiva()
    {
        $peralatan_kerja = $this->peralatan_kerja();
        $jumlah_aktiva_tetap = $this->jumlah_aktiva_tetap();
        $jumlah_cash = ($peralatan_kerja['total_peralatan_kerja'] + $jumlah_aktiva_tetap);
        return $jumlah_cash;
    }
    //-----------------------Total aktiva-----------------------------------------------
    public function hutang_afiliasi()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_hutang_afiliasi = 0;
        $hutang_afiliasi = Jurnal::where('Chart_Of_Account', 'HUTANG AFILIASI')->where('bs_pl', 'BS')->get();
        foreach ($hutang_afiliasi as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_hutang_afiliasi = $sum_debit - $sum_credit;
        }
        $data_hutang_afiliasi = array(
            'Nama' => 'HUTANG AFILIASI',
            'total_hutang_afiliasi' => $sum_hutang_afiliasi,
        );
        return $data_hutang_afiliasi;
    }

    public function afiliasi_fedora()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_afiliasi_fedora = 0;
        $afiliasi_fedora = Jurnal::where('Chart_Of_Account', 'Hutang Afiliasi - Fedora')->where('bs_pl', 'BS')->get();
        foreach ($afiliasi_fedora as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_afiliasi_fedora = $sum_debit - $sum_credit;
        }
        $data_afiliasi_fedora = array(
            'Nama' => 'Hutang Afiliasi - Fedora',
            'total_afiliasi_fedora' => $sum_afiliasi_fedora,
        );
        return $data_afiliasi_fedora;
    }

    public function hutang_dagang()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_hutang_dagang = 0;
        $hutang_dagang = Jurnal::where('Chart_Of_Account', 'Hutang Dagang - IDR')->where('bs_pl', 'BS')->get();
        foreach ($hutang_dagang as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_hutang_dagang = $sum_debit - $sum_credit;
        }
        $data_hutang_dagang = array(
            'Nama' => 'Hutang Dagang - IDR',
            'total_hutang_dagang' => $sum_hutang_dagang,
        );
        return $data_hutang_dagang;
    }

    public function hutang_ketiga()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_hutang_ketiga = 0;
        $hutang_ketiga = Jurnal::where('Chart_Of_Account', 'HUTANG PIHAK KETIGA')->where('bs_pl', 'BS')->get();
        foreach ($hutang_ketiga as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_hutang_ketiga = $sum_debit - $sum_credit;
        }
        $data_hutang_ketiga = array(
            'Nama' => 'HUTANG PIHAK KETIGA',
            'total_hutang_ketiga' => $sum_hutang_ketiga,
        );
        return $data_hutang_ketiga;
    }

    public function hutang_pph_21()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_hutang_pph_21 = 0;
        $hutang_pph_21 = Jurnal::where('Chart_Of_Account', 'Hutang Pajak - PPh 21')->where('bs_pl', 'BS')->get();
        foreach ($hutang_pph_21 as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_hutang_pph_21 = $sum_debit - $sum_credit;
        }
        $data_hutang_pph_21 = array(
            'Nama' => 'Hutang Pajak - PPh 21',
            'total_hutang_pph_21' => $sum_hutang_pph_21,
        );
        return $data_hutang_pph_21;
    }

    public function hutang_pph_23()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_hutang_pph_23 = 0;
        $hutang_pph_23 = Jurnal::where('Chart_Of_Account', 'Hutang Pajak - PPh 23')->where('bs_pl', 'BS')->get();
        foreach ($hutang_pph_23 as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_hutang_pph_23 = $sum_debit - $sum_credit;
        }
        $data_hutang_pph_23 = array(
            'Nama' => 'Hutang Pajak - PPh 23',
            'total_hutang_pph_23' => $sum_hutang_pph_23,
        );
        return $data_hutang_pph_23;
    }

    public function hutang_pph_4()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_hutang_pph_4 = 0;
        $hutang_pph_4 = Jurnal::where('Chart_Of_Account', 'Hutang Pajak - PPh 4')->where('bs_pl', 'BS')->get();
        foreach ($hutang_pph_4 as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_hutang_pph_4 = $sum_debit - $sum_credit;
        }
        $data_hutang_pph_4 = array(
            'Nama' => 'Hutang Pajak - PPh 4',
            'total_hutang_pph_4' => $sum_hutang_pph_4,
        );
        return $data_hutang_pph_4;
    }

    public function hutang_ppn_kurbay()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_hutang_ppn_kurbay = 0;
        $hutang_ppn_kurbay = Jurnal::where('Chart_Of_Account', 'Hutang Pajak - PPN Kurang Bayar')->where('bs_pl', 'BS')->get();
        foreach ($hutang_ppn_kurbay as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_hutang_ppn_kurbay = $sum_debit - $sum_credit;
        }
        $data_hutang_ppn_kurbay = array(
            'Nama' => 'Hutang Pajak - PPN Kurang Bayar',
            'total_hutang_ppn_kurbay' => $sum_hutang_ppn_kurbay,
        );
        return $data_hutang_ppn_kurbay;
    }

    public function dp_penjualan()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_dp_penjualan = 0;
        $dp_penjualan = Jurnal::where('Chart_Of_Account', 'Uang Muka Penjualan - IDR')->where('bs_pl', 'BS')->get();
        foreach ($dp_penjualan as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_dp_penjualan = $sum_debit - $sum_credit;
        }
        $data_dp_penjualan = array(
            'Nama' => 'Uang Muka Penjualan - IDR',
            'dp_penjualan' => $sum_dp_penjualan,
        );
        return $data_dp_penjualan;
    }

    public function dp_setoran_modal()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_dp_setoran_modal = 0;
        $dp_setoran_modal = Jurnal::where('Chart_Of_Account', 'Modal Disetor')->where('bs_pl', 'BS')->get();
        foreach ($dp_setoran_modal as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_dp_setoran_modal = $sum_debit - $sum_credit;
        }
        $data_dp_setoran_modal = array(
            'Nama' => 'Modal Disetor',
            'dp_setoran_modal' => $sum_dp_setoran_modal,
        );
        return $data_dp_setoran_modal;
    }

    public function jumlah_kewajiban_lancar()
    {
        $hutang_afiliasi = $this->hutang_afiliasi();
        $afiliasi_fedora = $this->afiliasi_fedora();
        $hutang_dagang = $this->hutang_dagang();
        $hutang_ketiga = $this->hutang_ketiga();
        $hutang_pph_21 = $this->hutang_pph_21();
        $hutang_pph_23 = $this->hutang_pph_23();
        $hutang_pph_4 = $this->hutang_pph_4();
        $hutang_ppn_kurbay = $this->hutang_ppn_kurbay();
        $dp_penjualan = $this->dp_penjualan();
        $dp_setoran_modal = $this->dp_setoran_modal();
        $jumlah_cash = (($hutang_afiliasi['total_hutang_afiliasi'] + $afiliasi_fedora['total_afiliasi_fedora'] + $hutang_dagang['total_hutang_dagang']
            + $hutang_ketiga['total_hutang_ketiga'] + $hutang_pph_21['total_hutang_pph_21'] + $hutang_pph_23['total_hutang_pph_23'] +
            + $hutang_pph_4['total_hutang_pph_4'] + $hutang_ppn_kurbay['total_hutang_ppn_kurbay'] + $dp_penjualan['dp_penjualan']
                + $dp_setoran_modal['dp_setoran_modal']));
        return $jumlah_cash;
    }
    //ekuitas
    public function modal_disetor()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_modal_disetor = 0;
        $modal_disetor = Jurnal::where('Chart_Of_Account', 'Modal Disetor')->where('bs_pl', 'BS')->get();
        foreach ($modal_disetor as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $modal_disetor = $sum_debit - $sum_credit;
        }
        $data_modal_disetor = array(
            'Nama' => 'Modal Disetor',
            'modal_disetor' => $sum_modal_disetor,
        );
        return $data_modal_disetor;
    }

    public function laba_ditahan()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_laba_ditahan = 0;
        $laba_ditahan = Jurnal::where('Chart_Of_Account', 'Laba Ditahan')->where('bs_pl', 'BS')->get();
        foreach ($laba_ditahan as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_laba_ditahan = $sum_debit - $sum_credit;
        }
        $data_laba_ditahan = array(
            'Nama' => 'Laba Ditahan',
            'laba_ditahan' => $sum_laba_ditahan,
        );
        return $data_laba_ditahan;
    }

    public function cadangan_dividen()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_cadangan_dividen = 0;
        $cadangan_dividen = Jurnal::where('Chart_Of_Account', 'Cadangan Deviden')->where('bs_pl', 'BS')->get();
        foreach ($cadangan_dividen as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_cadangan_dividen = $sum_debit - $sum_credit;
        }
        $data_cadangan_dividen = array(
            'Nama' => 'Cadangan Deviden',
            'cadangan_dividen' => $sum_cadangan_dividen,
        );
        return $data_cadangan_dividen;
    }

    public function jumlah_ekuitas()
    {
        $modal_disetor = $this->modal_disetor();
        $laba_ditahan = $this->laba_ditahan();
        $cadangan_dividen = $this->cadangan_dividen();
        $jumlah_cash = ($modal_disetor['modal_disetor'] + $laba_ditahan['laba_ditahan'] + $cadangan_dividen['cadangan_dividen']);
        return $jumlah_cash;
    }

    public function kewajiban_ekuitas()
    {
        $jumlah_ekuitas = $this->jumlah_ekuitas();
        $jumlah_kewajiban_lancar = $this->jumlah_kewajiban_lancar();
        $jumlah_kewajibab_ekuitas = $jumlah_ekuitas + $jumlah_kewajiban_lancar;
        return $jumlah_kewajibab_ekuitas;
    }




    public function neraca()
    {
        $bca_idr = $this->BCA_IDR();
        $bca_usd = $this->BCA_USD();
        $kas_kecil = $this->kas_kecil();
        $jumlah_kas = $this->jumlah_kas();
        $piutang_dagang = $this->piutang_dagang();
        $piutang_saham = $this->piutang_saham();
        $dp_pembelian = $this->dp_pembelian();
        $dp_karyawan = $this->dp_karyawan();
        $dp_pph = $this->dp_pph();
        $dimuka_gedung = $this->dimuka_gedung();
        $jumlah_aktiva_kas = $this->jumlah_aktiva_kas();
        $peralatan_kerja = $this->peralatan_kerja();
        $penyusutan_peralatan_kerja = $this->penyusutan_peralatan_kerja();
        $jumlah_aktiva_tetap = $this->jumlah_aktiva_tetap();
        $total_aktiva = $this->total_aktiva();

        $hutang_afiliasi = $this->hutang_afiliasi();
        $afiliasi_fedora = $this->afiliasi_fedora();
        $hutang_dagang = $this->hutang_dagang();
        $hutang_ketiga = $this->hutang_ketiga();
        $hutang_pph_21 = $this->hutang_pph_21();
        $hutang_pph_23 = $this->hutang_pph_23();
        $hutang_pph_4 = $this->hutang_pph_4();
        $hutang_ppn_kurbay = $this->hutang_ppn_kurbay();
        $dp_penjualan = $this->dp_penjualan();
        $dp_setoran_modal = $this->dp_setoran_modal();
        $jumlah_kewajiban_lancar = $this->jumlah_kewajiban_lancar();
        $modal_disetor = $this->modal_disetor();
        $laba_ditahan = $this->laba_ditahan();
        $cadangan_dividen = $this->cadangan_dividen();
        $jumlah_ekuitas = $this->jumlah_ekuitas();
        $kewajiban_ekuitas = $this->kewajiban_ekuitas();


        return view('jurnal.neraca.neraca',
        compact(
                'bca_idr',
                'bca_usd',
                'kas_kecil',
                'jumlah_kas',
                'piutang_dagang',
                'piutang_saham',
                'dp_pembelian',
                'dp_karyawan',
                'dp_pph',
                'dimuka_gedung',
                'jumlah_aktiva_kas',
                'peralatan_kerja',
                'penyusutan_peralatan_kerja',
                'jumlah_aktiva_tetap',
                'total_aktiva',
                'hutang_afiliasi',
                'afiliasi_fedora',
                'hutang_dagang',
                'hutang_ketiga',
                'hutang_pph_21',
                'hutang_pph_23',
                'hutang_pph_4',
                'hutang_ppn_kurbay',
                'dp_penjualan',
                'dp_setoran_modal',
                'jumlah_kewajiban_lancar',
                'modal_disetor',
                'laba_ditahan',
                'cadangan_dividen',
                'jumlah_ekuitas',
                'kewajiban_ekuitas'

        ));
    }
}
