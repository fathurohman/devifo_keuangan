<?php

namespace App\Http\Controllers;

use App\Model\Jurnal;
use Illuminate\Http\Request;
use App\Exports\NeracaExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class NeracaController extends Controller
{
    public function query_tarik($coa, $tahun, $start_month, $end_month)
    {
        return DB::select('select SUM(Debit) - SUM(Credit) AS total from jurnal 
        where Chart_Of_Account = "' . $coa . '"
        AND YEAR(`Trans_Date`)=' . $tahun . ' AND MONTH(`Trans_Date`) BETWEEN ' . $start_month . ' AND ' . $end_month . '
        AND bs_pl = "BS"');
    }
    public function BCA_IDR($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'BCA SIGMA IDR- 3728-888-557';
        $bca_idr = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_bca_idr = $bca_idr['0']->total;
        $data_bca_idr = array(
            'Nama' => 'BCA SIGMA IDR',
            'total_bca_idr' => $sum_bca_idr,
        );
        return $data_bca_idr;
    }

    public function BCA_USD($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'BCA SIGMA USD- 3728-888-506';
        $bca_usd = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_bca_usd = $bca_usd['0']->total;
        $data_bca_usd = array(
            'Nama' => 'BCA SIGMA USD',
            'total_bca_usd' => $sum_bca_usd,
        );
        return $data_bca_usd;
    }

    public function kas_kecil($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Kas Kecil Kantor Pusat - IDR';
        $kas_kecil = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_kas_kecil = $kas_kecil['0']->total;
        $data_kas_kecil = array(
            'Nama' => 'BCA SIGMA USD',
            'total_kas_kecil' => $sum_kas_kecil,
        );
        return $data_kas_kecil;
    }

    public function jumlah_kas($from, $to)
    {
        $bca_idr = $this->BCA_IDR($from, $to);
        $bca_usd = $this->BCA_USD($from, $to);
        $kas_kecil = $this->kas_kecil($from, $to);
        $jumlah_cash = ($bca_idr['total_bca_idr'] + $bca_usd['total_bca_usd'] + $kas_kecil['total_kas_kecil']);
        return $jumlah_cash;
    }
    //-------------------------------aktiva lancar -----------------------------------------
    public function piutang_dagang($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Piutang Dagang - IDR';
        $piutang_dagang = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_piutang_dagang = $piutang_dagang['0']->total;
        $data_piutang_dagang = array(
            'Nama' => 'Piutang Dagang - IDR',
            'total_piutang_dagang' => $sum_piutang_dagang,
        );
        return $data_piutang_dagang;
    }

    public function piutang_saham($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Piutang Pemegang Saham';
        $piutang_saham = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_piutang_saham = $piutang_saham['0']->total;
        $data_piutang_saham = array(
            'Nama' => 'Piutang Pemegang Saham',
            'total_piutang_saham' => $sum_piutang_saham,
        );
        return $data_piutang_saham;
    }

    public function dp_pembelian($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Uang Muka Pembelian - IDR';
        $dp_pembelian = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_dp_pembelian = $dp_pembelian['0']->total;
        $data_dp_pembelian = array(
            'Nama' => 'Uang Muka Pembelian',
            'total_dp_pembelian' => $sum_dp_pembelian,
        );
        return $data_dp_pembelian;
    }

    public function dp_karyawan($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Uang Muka Kerja Karyawan - IDR';
        $dp_karyawan = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_dp_karyawan = $dp_karyawan['0']->total;
        $data_dp_karyawan = array(
            'Nama' => 'Uang Muka Kerja Karyawan - IDR',
            'total_dp_karyawan' => $sum_dp_karyawan,
        );
        return $data_dp_karyawan;
    }

    public function dp_pph($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Pajak Dibayar Dimuka - PPH 23';
        $dp_pph = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_dp_pph = $dp_pph['0']->total;
        $data_dp_pph = array(
            'Nama' => 'Pajak Dibayar Dimuka - PPH 23',
            'total_dp_pph' => $sum_dp_pph,
        );
        return $data_dp_pph;
    }

    public function dimuka_gedung($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Biaya Dibayar Dimuka-Fasilitas Gedung';
        $dimuka_gedung = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_dimuka_gedung = $dimuka_gedung['0']->total;
        $data_dimuka_gedung = array(
            'Nama' => 'Biaya Dibayar Dimuka - Fasilitas Gedung',
            'total_dimuka_gedung' => $sum_dimuka_gedung,
        );
        return $data_dimuka_gedung;
    }

    public function jumlah_aktiva_kas($from, $to)
    {
        $piutang_dagang = $this->piutang_dagang($from, $to);
        $piutang_saham = $this->piutang_saham($from, $to);
        $dp_pembelian = $this->dp_pembelian($from, $to);
        $dp_karyawan = $this->dp_karyawan($from, $to);
        $dp_pph = $this->dp_pph($from, $to);
        $dimuka_gedung = $this->dimuka_gedung($from, $to);
        $jumlah_kas = $this->jumlah_kas($from, $to);
        $jumlah_cash = ($piutang_dagang['total_piutang_dagang'] + $piutang_saham['total_piutang_saham'] + $dp_pembelian['total_dp_pembelian']
            + $dp_karyawan['total_dp_karyawan'] + $dp_pph['total_dp_pph'] + $dimuka_gedung['total_dimuka_gedung'] + $jumlah_kas);
        return $jumlah_cash;
    }
    //----------------aktiva lancar-------------------------------------------
    public function peralatan_kerja($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Aktiva Jakarta - Peralatan Kerja';
        $peralatan_kerja = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_peralatan_kerja = $peralatan_kerja['0']->total;
        $data_peralatan_kerja = array(
            'Nama' => 'Aktiva Jakarta - Peralatan Kerja',
            'total_peralatan_kerja' => $sum_peralatan_kerja,
        );
        return $data_peralatan_kerja;
    }

    public function penyusutan_peralatan_kerja($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Akumulasi Penyusutan - Peralatan Kerja';
        $penyusutan_peralatan_kerja = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_penyusutan_peralatan_kerja = $penyusutan_peralatan_kerja['0']->total;
        $data_penyusutan_peralatan_kerja = array(
            'Nama' => 'Akumulasi Penyusutan - Peralatan Kerja',
            'total_penyusutan_peralatan_kerja' => $sum_penyusutan_peralatan_kerja,
        );
        return $data_penyusutan_peralatan_kerja;
    }

    public function jumlah_aktiva_tetap($from, $to)
    {
        $peralatan_kerja = $this->peralatan_kerja($from, $to);
        $penyusutan_peralatan_kerja = $this->penyusutan_peralatan_kerja($from, $to);
        $jumlah_cash = ($peralatan_kerja['total_peralatan_kerja'] + $penyusutan_peralatan_kerja['total_penyusutan_peralatan_kerja']);
        return $jumlah_cash;
    }

    public function total_aktiva($from, $to)
    {
        $jumlah_aktiva_kas = $this->jumlah_aktiva_kas($from, $to);
        $jumlah_aktiva_tetap = $this->jumlah_aktiva_tetap($from, $to);
        $jumlah_cash = ($jumlah_aktiva_kas + $jumlah_aktiva_tetap);
        return $jumlah_cash;
    }
    //-----------------------Total aktiva-----------------------------------------------
    public function hutang_afiliasi($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Hutang Afiliasi - DUI';
        $hutang_afiliasi = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_hutang_afiliasi = abs($hutang_afiliasi['0']->total);
        $data_hutang_afiliasi = array(
            'Nama' => 'Hutang Afiliasi - DUI',
            'total_hutang_afiliasi' => $sum_hutang_afiliasi,
        );
        return $data_hutang_afiliasi;
    }

    public function afiliasi_fedora($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Hutang Afiliasi - Fedora';
        $afiliasi_fedora = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_afiliasi_fedora = $afiliasi_fedora['0']->total;
        $data_afiliasi_fedora = array(
            'Nama' => 'Hutang Afiliasi - Fedora',
            'total_afiliasi_fedora' => $sum_afiliasi_fedora,
        );
        return $data_afiliasi_fedora;
    }

    public function hutang_dagang($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Hutang Dagang - IDR';
        $hutang_dagang = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_hutang_dagang = $hutang_dagang['0']->total;
        $data_hutang_dagang = array(
            'Nama' => 'Hutang Dagang - IDR',
            'total_hutang_dagang' => $sum_hutang_dagang,
        );
        return $data_hutang_dagang;
    }

    public function hutang_ketiga($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Hutang Pihak Ketiga';
        $hutang_ketiga = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_hutang_ketiga = $hutang_ketiga['0']->total;
        $data_hutang_ketiga = array(
            'Nama' => 'Hutang Pihak Ketiga',
            'total_hutang_ketiga' => $sum_hutang_ketiga,
        );
        return $data_hutang_ketiga;
    }

    public function hutang_pph_21($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Hutang Pajak - PPh 21';
        $hutang_pph_21 = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_hutang_pph_21 = $hutang_pph_21['0']->total;
        $data_hutang_pph_21 = array(
            'Nama' => 'Hutang Pajak - PPh 21',
            'total_hutang_pph_21' => $sum_hutang_pph_21,
        );
        return $data_hutang_pph_21;
    }

    public function hutang_pph_23($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Hutang Pajak - PPh 23';
        $hutang_pph_23 = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_hutang_pph_23 = abs($hutang_pph_23['0']->total);
        $data_hutang_pph_23 = array(
            'Nama' => 'Hutang Pajak - PPh 23',
            'total_hutang_pph_23' => $sum_hutang_pph_23,
        );
        return $data_hutang_pph_23;
    }

    public function hutang_pph_4($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Hutang Pajak - PPh 4 (2)';
        $hutang_pph_4 = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_hutang_pph_4 = $hutang_pph_4['0']->total;
        $data_hutang_pph_4 = array(
            'Nama' => 'Hutang Pajak - PPh 4 (2)',
            'total_hutang_pph_4' => $sum_hutang_pph_4,
        );
        return $data_hutang_pph_4;
    }

    public function hutang_ppn_kurbay($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Hutang PPn Kurang Bayar';
        $hutang_ppn_kurbay = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_hutang_ppn_kurbay = abs($hutang_ppn_kurbay['0']->total);
        $data_hutang_ppn_kurbay = array(
            'Nama' => 'Hutang PPn Kurang Bayar',
            'total_hutang_ppn_kurbay' => $sum_hutang_ppn_kurbay,
        );
        return $data_hutang_ppn_kurbay;
    }

    public function dp_penjualan($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Uang Muka Penjualan - IDR';
        $dp_penjualan = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_dp_penjualan = abs($dp_penjualan['0']->total);
        $data_dp_penjualan = array(
            'Nama' => 'Uang Muka Penjualan - IDR',
            'dp_penjualan' => $sum_dp_penjualan,
        );
        return $data_dp_penjualan;
    }

    public function dp_setoran_modal($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Uang Muka Setoran Modal';
        $dp_setoran_modal = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_dp_setoran_modal = $dp_setoran_modal['0']->total;
        $data_dp_setoran_modal = array(
            'Nama' => 'Uang Muka Setoran Modal',
            'dp_setoran_modal' => $sum_dp_setoran_modal,
        );
        return $data_dp_setoran_modal;
    }

    public function jumlah_kewajiban_lancar($from, $to)
    {
        $hutang_afiliasi = $this->hutang_afiliasi($from, $to);
        $afiliasi_fedora = $this->afiliasi_fedora($from, $to);
        $hutang_dagang = $this->hutang_dagang($from, $to);
        $hutang_ketiga = $this->hutang_ketiga($from, $to);
        $hutang_pph_21 = $this->hutang_pph_21($from, $to);
        $hutang_pph_23 = $this->hutang_pph_23($from, $to);
        $hutang_pph_4 = $this->hutang_pph_4($from, $to);
        $hutang_ppn_kurbay = $this->hutang_ppn_kurbay($from, $to);
        $dp_penjualan = $this->dp_penjualan($from, $to);
        $dp_setoran_modal = $this->dp_setoran_modal($from, $to);
        $jumlah_cash = (($hutang_afiliasi['total_hutang_afiliasi'] + $afiliasi_fedora['total_afiliasi_fedora'] + $hutang_dagang['total_hutang_dagang']
            + $hutang_ketiga['total_hutang_ketiga'] + $hutang_pph_21['total_hutang_pph_21'] + $hutang_pph_23['total_hutang_pph_23'] +
            +$hutang_pph_4['total_hutang_pph_4'] + $hutang_ppn_kurbay['total_hutang_ppn_kurbay'] + $dp_penjualan['dp_penjualan']
                + $dp_setoran_modal['dp_setoran_modal']));
        return $jumlah_cash;
    }
    //ekuitas
    public function modal_disetor($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Modal Disetor';
        $modal_disetor = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_modal_disetor = $modal_disetor['0']->total;
        $modal_disetor = Jurnal::whereBetween('Trans_Date', [$from, $to])->where('Chart_Of_Account', 'Modal Disetor')->where('bs_pl', 'BS')->get();
        $data_modal_disetor = array(
            'Nama' => 'Modal Disetor',
            'modal_disetor' => $sum_modal_disetor,
        );
        return $data_modal_disetor;
    }

    public function laba_ditahan($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Laba/Rugi ditahan';
        $laba_ditahan = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_laba_ditahan = abs($laba_ditahan['0']->total);
        $data_laba_ditahan = array(
            'Nama' => 'Laba/Rugi ditahan',
            'laba_ditahan' => $sum_laba_ditahan,
        );
        return $data_laba_ditahan;
    }

    public function laba_ditahun_berjalan($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Laba/Rugi ditahun berjalan';
        $laba_ditahun_berjalan = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_laba_ditahun_berjalan = $laba_ditahun_berjalan['0']->total;
        $data_laba_ditahun_berjalan = array(
            'Nama' => 'Laba/Rugi ditahun berjalan',
            'laba_ditahun_berjalan' => $sum_laba_ditahun_berjalan,
        );
        return $data_laba_ditahun_berjalan;
    }

    public function cadangan_dividen($from, $to)
    {
        $tahun = Carbon::now()->format('Y');
        $coa = 'Deviden';
        $cadangan_dividen = $this->query_tarik($coa, $tahun, $from, $to);
        $sum_cadangan_dividen = $cadangan_dividen['0']->total;
        $data_cadangan_dividen = array(
            'Nama' => 'Deviden',
            'cadangan_dividen' => $sum_cadangan_dividen,
        );
        return $data_cadangan_dividen;
    }

    public function jumlah_ekuitas($from, $to)
    {
        $modal_disetor = $this->modal_disetor($from, $to);
        $laba_ditahan = $this->laba_ditahan($from, $to);
        $cadangan_dividen = $this->cadangan_dividen($from, $to);
        $jumlah_cash = ($modal_disetor['modal_disetor'] + $laba_ditahan['laba_ditahan'] + $cadangan_dividen['cadangan_dividen']);
        return $jumlah_cash;
    }

    public function kewajiban_ekuitas($from, $to)
    {
        $jumlah_ekuitas = $this->jumlah_ekuitas($from, $to);
        $jumlah_kewajiban_lancar = $this->jumlah_kewajiban_lancar($from, $to);
        $jumlah_kewajibab_ekuitas = $jumlah_ekuitas + $jumlah_kewajiban_lancar;
        return $jumlah_kewajibab_ekuitas;
    }


    public function neraca_json(Request $request)
    {

        $from = $request->from;
        $to = $request->to;

        $bca_idr = $this->BCA_IDR($from, $to);
        $bca_usd = $this->BCA_USD($from, $to);
        $kas_kecil = $this->kas_kecil($from, $to);
        $jumlah_kas = $this->jumlah_kas($from, $to);
        $piutang_dagang = $this->piutang_dagang($from, $to);
        $piutang_saham = $this->piutang_saham($from, $to);
        $dp_pembelian = $this->dp_pembelian($from, $to);
        $dp_karyawan = $this->dp_karyawan($from, $to);
        $dp_pph = $this->dp_pph($from, $to);
        $dimuka_gedung = $this->dimuka_gedung($from, $to);
        $jumlah_aktiva_kas = $this->jumlah_aktiva_kas($from, $to);
        $peralatan_kerja = $this->peralatan_kerja($from, $to);
        $penyusutan_peralatan_kerja = $this->penyusutan_peralatan_kerja($from, $to);
        $jumlah_aktiva_tetap = $this->jumlah_aktiva_tetap($from, $to);
        $total_aktiva = $this->total_aktiva($from, $to);

        $hutang_afiliasi = $this->hutang_afiliasi($from, $to);
        $afiliasi_fedora = $this->afiliasi_fedora($from, $to);
        $hutang_dagang = $this->hutang_dagang($from, $to);
        $hutang_ketiga = $this->hutang_ketiga($from, $to);
        $hutang_pph_21 = $this->hutang_pph_21($from, $to);
        $hutang_pph_23 = $this->hutang_pph_23($from, $to);
        $hutang_pph_4 = $this->hutang_pph_4($from, $to);
        $hutang_ppn_kurbay = $this->hutang_ppn_kurbay($from, $to);
        $dp_penjualan = $this->dp_penjualan($from, $to);
        $dp_setoran_modal = $this->dp_setoran_modal($from, $to);
        $jumlah_kewajiban_lancar = $this->jumlah_kewajiban_lancar($from, $to);
        $modal_disetor = $this->modal_disetor($from, $to);
        $laba_ditahan = $this->laba_ditahan($from, $to);
        $laba_ditahun_berjalan = $this->laba_ditahun_berjalan($from, $to);
        $cadangan_dividen = $this->cadangan_dividen($from, $to);
        $jumlah_ekuitas = $this->jumlah_ekuitas($from, $to);
        $kewajiban_ekuitas = $this->kewajiban_ekuitas($from, $to);

        $html = view('jurnal.neraca.table_neraca')->with(
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
                'laba_ditahun_berjalan',
                'cadangan_dividen',
                'jumlah_ekuitas',
                'kewajiban_ekuitas'
            )
        )->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function neraca()
    {
        $month_list = array_reduce(range(1, 12), function ($rslt, $m) {
            $rslt[$m] = date('F', mktime(0, 0, 0, $m, 10));
            return $rslt;
        });
        return view('jurnal.neraca.neraca', compact('month_list'));
    }

    public function export_neraca(Request $request)
    {
        $from = $request->start;
        $to = $request->end;

        $bca_idr = $this->BCA_IDR($from, $to);
        $bca_usd = $this->BCA_USD($from, $to);
        $kas_kecil = $this->kas_kecil($from, $to);
        $jumlah_kas = $this->jumlah_kas($from, $to);
        $piutang_dagang = $this->piutang_dagang($from, $to);
        $piutang_saham = $this->piutang_saham($from, $to);
        $dp_pembelian = $this->dp_pembelian($from, $to);
        $dp_karyawan = $this->dp_karyawan($from, $to);
        $dp_pph = $this->dp_pph($from, $to);
        $dimuka_gedung = $this->dimuka_gedung($from, $to);
        $jumlah_aktiva_kas = $this->jumlah_aktiva_kas($from, $to);
        $peralatan_kerja = $this->peralatan_kerja($from, $to);
        $penyusutan_peralatan_kerja = $this->penyusutan_peralatan_kerja($from, $to);
        $jumlah_aktiva_tetap = $this->jumlah_aktiva_tetap($from, $to);
        $total_aktiva = $this->total_aktiva($from, $to);

        $hutang_afiliasi = $this->hutang_afiliasi($from, $to);
        $afiliasi_fedora = $this->afiliasi_fedora($from, $to);
        $hutang_dagang = $this->hutang_dagang($from, $to);
        $hutang_ketiga = $this->hutang_ketiga($from, $to);
        $hutang_pph_21 = $this->hutang_pph_21($from, $to);
        $hutang_pph_23 = $this->hutang_pph_23($from, $to);
        $hutang_pph_4 = $this->hutang_pph_4($from, $to);
        $hutang_ppn_kurbay = $this->hutang_ppn_kurbay($from, $to);
        $dp_penjualan = $this->dp_penjualan($from, $to);
        $dp_setoran_modal = $this->dp_setoran_modal($from, $to);
        $jumlah_kewajiban_lancar = $this->jumlah_kewajiban_lancar($from, $to);
        $modal_disetor = $this->modal_disetor($from, $to);
        $laba_ditahan = $this->laba_ditahan($from, $to);
        $cadangan_dividen = $this->cadangan_dividen($from, $to);
        $jumlah_ekuitas = $this->jumlah_ekuitas($from, $to);
        $kewajiban_ekuitas = $this->kewajiban_ekuitas($from, $to);

        $download = Excel::download(new NeracaExport($from, $to, $bca_idr, $bca_usd, $kas_kecil, $jumlah_kas, $piutang_dagang, $piutang_saham, $dp_pembelian, $dp_karyawan, $dp_pph, $dimuka_gedung, $jumlah_aktiva_kas, $peralatan_kerja, $penyusutan_peralatan_kerja, $jumlah_aktiva_tetap, $total_aktiva, $hutang_afiliasi, $afiliasi_fedora, $hutang_dagang, $hutang_ketiga, $hutang_pph_21, $hutang_pph_23, $hutang_pph_4, $hutang_ppn_kurbay, $dp_penjualan, $dp_setoran_modal, $jumlah_kewajiban_lancar, $modal_disetor, $laba_ditahan, $cadangan_dividen, $jumlah_ekuitas, $kewajiban_ekuitas), 'Neraca.xlsx');
        return $download;
    }
}
