<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class NeracaExport implements FromView, ShouldAutoSize, WithStrictNullComparison
{
    protected $from, $to, $bca_idr, $bca_usd, $kas_kecil, $jumlah_kas, $piutang_dagang, $piutang_saham, $dp_pembelian, $dp_karyawan, $dp_pph, $dimuka_gedung, $jumlah_aktiva_kas, $peralatan_kerja, $penyusutan_peralatan_kerja, $jumlah_aktiva_tetap, $total_aktiva, $hutang_afiliasi, $afiliasi_fedora, $hutang_dagang, $hutang_ketiga, $hutang_pph_21, $hutang_pph_23, $hutang_pph_4, $hutang_ppn_kurbay, $dp_penjualan, $dp_setoran_modal, $jumlah_kewajiban_lancar, $modal_disetor, $laba_ditahan, $cadangan_dividen, $jumlah_ekuitas, $kewajiban_ekuitas;

    function __construct($from, $to, $bca_idr, $bca_usd, $kas_kecil, $jumlah_kas, $piutang_dagang, $piutang_saham, $dp_pembelian, $dp_karyawan, $dp_pph, $dimuka_gedung, $jumlah_aktiva_kas, $peralatan_kerja, $penyusutan_peralatan_kerja, $jumlah_aktiva_tetap, $total_aktiva, $hutang_afiliasi, $afiliasi_fedora, $hutang_dagang, $hutang_ketiga, $hutang_pph_21, $hutang_pph_23, $hutang_pph_4, $hutang_ppn_kurbay, $dp_penjualan, $dp_setoran_modal, $jumlah_kewajiban_lancar, $modal_disetor, $laba_ditahan, $cadangan_dividen, $jumlah_ekuitas, $kewajiban_ekuitas)
    {
            $this->from = $from;
            $this->to = $to;
            $this->bca_idr = $bca_idr;
            $this->bca_usd = $bca_usd;
            $this->kas_kecil = $kas_kecil;
            $this->jumlah_kas = $jumlah_kas;
            $this->piutang_dagang = $piutang_dagang;
            $this->piutang_saham = $piutang_saham;
            $this->dp_pembelian = $dp_pembelian;
            $this->dp_karyawan = $dp_karyawan;
            $this->dp_pph = $dp_pph;
            $this->dimuka_gedung = $dimuka_gedung;
            $this->jumlah_aktiva_kas = $jumlah_aktiva_kas;
            $this->peralatan_kerja = $peralatan_kerja;
            $this->penyusutan_peralatan_kerja = $penyusutan_peralatan_kerja;
            $this->jumlah_aktiva_tetap = $jumlah_aktiva_tetap;
            $this->total_aktiva = $total_aktiva;
            $this->hutang_afiliasi = $hutang_afiliasi;
            $this->afiliasi_fedora = $afiliasi_fedora;
            $this->hutang_dagang = $hutang_dagang;
            $this->hutang_ketiga = $hutang_ketiga;
            $this->hutang_pph_21 = $hutang_pph_21;
            $this->hutang_pph_23 = $hutang_pph_23;
            $this->hutang_pph_4 = $hutang_pph_4;
            $this->hutang_ppn_kurbay = $hutang_ppn_kurbay;
            $this->dp_penjualan = $dp_penjualan;
            $this->dp_setoran_modal = $dp_setoran_modal;
            $this->jumlah_kewajiban_lancar = $jumlah_kewajiban_lancar;
            $this->modal_disetor = $modal_disetor;
            $this->laba_ditahan = $laba_ditahan;
            $this->cadangan_dividen = $cadangan_dividen;
            $this->jumlah_ekuitas = $jumlah_ekuitas;
            $this->kewajiban_ekuitas = $kewajiban_ekuitas;
    }

    public function view(): View
    {

            $bca_idr = $this->bca_idr;
            $bca_usd = $this->bca_usd;
            $kas_kecil = $this->kas_kecil;
            $jumlah_kas = $this->jumlah_kas;
            $piutang_dagang = $this->piutang_dagang;
            $piutang_saham = $this->piutang_saham;
            $dp_pembelian = $this->dp_pembelian;
            $dp_karyawan = $this->dp_karyawan;
            $dp_pph = $this->dp_pph;
            $dimuka_gedung = $this->dimuka_gedung;
            $jumlah_aktiva_kas = $this->jumlah_aktiva_kas;
            $peralatan_kerja = $this->peralatan_kerja;
            $penyusutan_peralatan_kerja = $this->penyusutan_peralatan_kerja;
            $jumlah_aktiva_tetap = $this->jumlah_aktiva_tetap;
            $total_aktiva = $this->total_aktiva;
            $hutang_afiliasi = $this->hutang_afiliasi;
            $afiliasi_fedora = $this->afiliasi_fedora;
            $hutang_dagang = $this->hutang_dagang;
            $hutang_ketiga = $this->hutang_ketiga;
            $hutang_pph_21 = $this->hutang_pph_21;
            $hutang_pph_23 = $this->hutang_pph_23;
            $hutang_pph_4 = $this->hutang_pph_4;
            $hutang_ppn_kurbay = $this->hutang_ppn_kurbay;
            $dp_penjualan = $this->dp_penjualan;
            $dp_setoran_modal = $this->dp_setoran_modal;
            $jumlah_kewajiban_lancar = $this->jumlah_kewajiban_lancar;
            $modal_disetor = $this->modal_disetor;
            $laba_ditahan = $this->laba_ditahan;
            $cadangan_dividen = $this->cadangan_dividen;
            $jumlah_ekuitas = $this->jumlah_ekuitas;
            $kewajiban_ekuitas = $this->kewajiban_ekuitas;

        return view('jurnal.neraca.export_neraca', [
            'bca_idr' => $bca_idr,
            'bca_usd' => $bca_usd,
            'kas_kecil' => $kas_kecil,
            'jumlah_kas' => $jumlah_kas,
            'piutang_dagang' => $piutang_dagang,
            'piutang_saham' => $piutang_saham,
            'dp_pembelian' => $dp_pembelian,
            'dp_karyawan' => $dp_karyawan,
            'dp_pph' => $dp_pph,
            'dimuka_gedung' => $dimuka_gedung,
            'jumlah_aktiva_kas' => $jumlah_aktiva_kas,
            'peralatan_kerja' => $peralatan_kerja,
            'penyusutan_peralatan_kerja' => $penyusutan_peralatan_kerja,
            'jumlah_aktiva_tetap' => $jumlah_aktiva_tetap,
            'total_aktiva' => $total_aktiva,
            'hutang_afiliasi' => $hutang_afiliasi,
            'afiliasi_fedora' => $afiliasi_fedora,
            'hutang_dagang' => $hutang_dagang,
            'hutang_ketiga' => $hutang_ketiga,
            'hutang_pph_21' => $hutang_pph_21,
            'hutang_pph_23' => $hutang_pph_23,
            'hutang_pph_4' => $hutang_pph_4,
            'hutang_ppn_kurbay' => $hutang_ppn_kurbay,
            'dp_penjualan' => $dp_penjualan,
            'dp_setoran_modal' => $dp_setoran_modal,
            'jumlah_kewajiban_lancar' => $jumlah_kewajiban_lancar,
            'modal_disetor' => $modal_disetor,
            'laba_ditahan' => $laba_ditahan,
            'cadangan_dividen' => $cadangan_dividen,
            'jumlah_ekuitas' => $jumlah_ekuitas,
            'kewajiban_ekuitas' => $kewajiban_ekuitas
        ]);
    }
}
