<?php

namespace App\Http\Controllers;

use App\Model\Jurnal;
use Illuminate\Http\Request;

class ProfitLossController extends Controller
{
    public function penjualan()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_jual = 0;
        $penjualan = Jurnal::where('Chart_Of_Account', 'Penjualan')->where('bs_pl', 'PL')->get();
        foreach ($penjualan as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_jual = abs($sum_debit - $sum_credit);
        }
        $data_jual = array(
            'Nama' => 'PENJUALAN',
            'total_penjualan' => $sum_jual,
        );
        return $data_jual;
    }

    public function hapok()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_hapok = 0;
        $hapok = Jurnal::where('Chart_Of_Account', 'Harga Pokok Penjualan')->where('bs_pl', 'PL')->get();
        foreach ($hapok as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_hapok += -1 * abs($sum_debit - $sum_credit);
        }
        $data_hapok = array(
            'Nama' => 'Harga Pokok Penjualan',
            'total_hapok' => $sum_hapok,
        );
        return $data_hapok;
    }

    public function potongan_beli()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_potong_beli = 0;
        $potong_beli = Jurnal::where('Chart_Of_Account', 'Potongan Pembelian')->where('bs_pl', 'PL')->get();
        foreach ($potong_beli as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_potong_beli += $sum_debit - $sum_credit;
        }
        $data_potong_beli = array(
            'Nama' => 'Potongan Pembelian',
            'total_pot_beli' => $sum_potong_beli,
        );
        return $data_potong_beli;
    }

    public function badmumum_atk()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_atk = 0;
        $atk = Jurnal::where('Chart_Of_Account', 'B. Adm & Umum - Alat Tulis Kantor')->where('bs_pl', 'PL')->get();
        foreach ($atk as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_atk += $sum_debit - $sum_credit;
        }
        $data_atk = array(
            'Nama' => 'B. Adm & Umum - Alat Tulis Kantor',
            'total_atk' => $sum_atk,
        );
        return $data_atk;
    }

    public function badmumum_bp_pph21()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_bp_pph21 = 0;
        $bp_pph21 = Jurnal::where('Chart_Of_Account', 'B. Adm & Umum - Biaya Pajak PPh 21 Non KA/Ryawan')->where('bs_pl', 'PL')->get();
        foreach ($bp_pph21 as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_bp_pph21 += $sum_debit - $sum_credit;
        }
        $data_bp_pph21 = array(
            'Nama' => 'B. Adm & Umum - Biaya Pajak PPh 21',
            'total_bp_pph21' => $sum_bp_pph21,
        );
        return $data_bp_pph21;
    }

    public function badmumum_bp_pph23()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_bp_pph23 = 0;
        $bp_pph23 = Jurnal::where('Chart_Of_Account', 'B. Adm & Umum - Biaya Pajak PPh 23')->where('bs_pl', 'PL')->get();
        foreach ($bp_pph23 as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_bp_pph23 += $sum_debit - $sum_credit;
        }
        $data_bp_pph23 = array(
            'Nama' => 'B. Adm & Umum - Biaya Pajak PPh 23',
            'total_bp_pph23' => $sum_bp_pph23,
        );
        return $data_bp_pph23;
    }

    public function badmumum_bp_pph4()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_bp_pph4 = 0;
        $bp_pph4 = Jurnal::where('Chart_Of_Account', 'B. Adm & Umum - Biaya Pajak PPh 4(2)')->where('bs_pl', 'PL')->get();
        foreach ($bp_pph4 as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_bp_pph4 += $sum_debit - $sum_credit;
        }
        $data_bp_pph4 = array(
            'Nama' => 'B. Adm & Umum - Biaya Pajak PPh 4 (2)',
            'total_bp_pph4' => $sum_bp_pph4,
        );
        return $data_bp_pph4;
    }

    public function badmumum_dapur()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_dapur = 0;
        $dapur = Jurnal::where('Chart_Of_Account', 'B. Adm & Umum - Dapur')->where('bs_pl', 'PL')->get();
        foreach ($dapur as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_dapur += $sum_debit - $sum_credit;
        }
        $data_dapur = array(
            'Nama' => 'B. Adm & Umum - Dapur',
            'total_dapur' => $sum_dapur,
        );
        return $data_dapur;
    }

    public function badmumum_la()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_la = 0;
        $la = Jurnal::where('Chart_Of_Account', 'B. Adm & Umum - Listrik & Air')->where('bs_pl', 'PL')->get();
        foreach ($la as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_la += $sum_debit - $sum_credit;
        }
        $data_la = array(
            'Nama' => 'B. Adm & Umum - Listrik & Air',
            'total_la' => $sum_la,
        );
        return $data_la;
    }

    public function badmumum_materai()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_materai = 0;
        $materai = Jurnal::where('Chart_Of_Account', 'B. Adm & Umum - Materai')->where('bs_pl', 'PL')->get();
        foreach ($materai as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_materai += $sum_debit - $sum_credit;
        }
        $data_materai = array(
            'Nama' => 'B. Adm & Umum - Materai',
            'total_materai' => $sum_materai,
        );
        return $data_materai;
    }

    public function badmumum_pencetakan()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_pencetakan = 0;
        $pencetakan = Jurnal::where('Chart_Of_Account', 'B. Adm & Umum - Pencetakan')->where('bs_pl', 'PL')->get();
        foreach ($pencetakan as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_pencetakan += $sum_debit - $sum_credit;
        }
        $data_pencetakan = array(
            'Nama' => 'B. Adm & Umum - Pencetakan',
            'total_pencetakan' => $sum_pencetakan,
        );
        return $data_pencetakan;
    }

    public function badmumum_jaspro()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_jaspro = 0;
        $jaspro = Jurnal::where('Chart_Of_Account', 'B. Adm & Umum - Jasa Profesional')->where('bs_pl', 'PL')->get();
        foreach ($jaspro as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_jaspro += $sum_debit - $sum_credit;
        }
        $data_jaspro = array(
            'Nama' => 'B. Adm & Umum - Jasa Profesional',
            'total_jaspro' => $sum_jaspro,
        );
        return $data_jaspro;
    }

    public function badmumum_manfee()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_manfee = 0;
        $manfee = Jurnal::where('Chart_Of_Account', 'B. Adm & Umum - Management Fee')->where('bs_pl', 'PL')->get();
        foreach ($manfee as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_manfee += $sum_debit - $sum_credit;
        }
        $data_manfee = array(
            'Nama' => 'B. Adm & Umum - Management Fee',
            'total_manfee' => $sum_manfee,
        );
        return $data_manfee;
    }

    public function badmumum_ppbd()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_ppbd = 0;
        $ppbd = Jurnal::where('Chart_Of_Account', 'B. Adm & Umum - Pos dan Pengiriman Barang/Dokumen')->where('bs_pl', 'PL')->get();
        foreach ($ppbd as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_ppbd += $sum_debit - $sum_credit;
        }
        $data_ppbd = array(
            'Nama' => 'B. Adm & Umum - Pos dan Pengiriman Barang/Dokumen',
            'total_ppbd' => $sum_ppbd,
        );
        return $data_ppbd;
    }

    public function badmumum_tagin()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_tagin = 0;
        $tagin = Jurnal::where('Chart_Of_Account', 'Site - B. Adm & Umum - Tagihan Internet')->where('bs_pl', 'PL')->get();
        foreach ($tagin as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_tagin += $sum_debit - $sum_credit;
        }
        $data_tagin = array(
            'Nama' => 'Site - B. Adm & Umum - Tagihan Internet',
            'total_tagin' => $sum_tagin,
        );
        return $data_tagin;
    }

    public function badmumum_tagtel()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_tagtel = 0;
        $tagtel = Jurnal::where('Chart_Of_Account', 'Site - B. Adm & Umum - Tagihan Telpon')->where('bs_pl', 'PL')->get();
        foreach ($tagtel as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_tagtel += $sum_debit - $sum_credit;
        }
        $data_tagtel = array(
            'Nama' => 'Site - B. Adm & Umum - Tagihan Telpon',
            'total_tagtel' => $sum_tagtel,
        );
        return $data_tagtel;
    }

    public function badmumum_transportasi()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_transportasi = 0;
        $transportasi = Jurnal::where('Chart_Of_Account', 'B. Adm & Umum - Transportasi')->where('bs_pl', 'PL')->get();
        foreach ($transportasi as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_transportasi += $sum_debit - $sum_credit;
        }
        $data_transportasi = array(
            'Nama' => 'B. Adm & Umum - Transportasi',
            'total_transportasi' => $sum_transportasi,
        );
        return $data_transportasi;
    }

    public function bdd__bp_pph23()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_bdd__bp_pph23 = 0;
        $bdd__bp_pph23 = Jurnal::where('Chart_Of_Account', 'Pajak Dibayar Dimuka - PPH 23')->where('bs_pl', 'PL')->get();
        foreach ($bdd__bp_pph23 as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_bdd__bp_pph23 += $sum_debit - $sum_credit;
        }
        $data_bdd__bp_pph23 = array(
            'Nama' => 'B. Dibayar Dimuka - Biaya Pajak PPh 23',
            'total_bdd__bp_pph23' => $sum_bdd__bp_pph23,
        );
        return $data_bdd__bp_pph23;
    }

    public function bp_sewken()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_bp_sewken = 0;
        $bp_sewken = Jurnal::where('Chart_Of_Account', 'B. Penjualan - Sewa KendA/Raan')->where('bs_pl', 'PL')->get();
        foreach ($bp_sewken as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_bp_sewken += $sum_debit - $sum_credit;
        }
        $data_bp_sewken = array(
            'Nama' => 'B. Penjualan - Sewa KendaRaan',
            'total_bp_sewken' => $sum_bp_sewken,
        );
        return $data_bp_sewken;
    }

    public function bp_perker()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_bp_perker = 0;
        $bp_perker = Jurnal::where('Chart_Of_Account', 'B. Penyusutan - Peralatan Kerja')->where('bs_pl', 'PL')->get();
        foreach ($bp_perker as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_bp_perker += $sum_debit - $sum_credit;
        }
        $data_bp_perker = array(
            'Nama' => 'B. Penyusutan - Peralatan Kerja',
            'total_bp_perker' => $sum_bp_perker,
        );
        return $data_bp_perker;
    }

    public function bab()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_bab = 0;
        $bab = Jurnal::where('Chart_Of_Account', 'Biaya Administrasi Bank')->where('bs_pl', 'PL')->get();
        foreach ($bab as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_bab += $sum_debit - $sum_credit;
        }
        $data_bab = array(
            'Nama' => 'Biaya Administrasi Bank',
            'total_bab' => $sum_bab,
        );
        return $data_bab;
    }
    //-----///
    public function bgu()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_bgu = 0;
        $bgu = Jurnal::where('Chart_Of_Account', 'Biaya Gaji & Upah')->where('bs_pl', 'PL')->get();
        foreach ($bgu as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_bgu += $sum_debit - $sum_credit;
        }
        $data_bgu = array(
            'Nama' => 'Biaya Gaji & Upah',
            'total_bgu' => $sum_bgu,
        );
        return $data_bgu;
    }

    public function bll()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_bll = 0;
        $bll = Jurnal::where('Chart_Of_Account', 'Biaya Lain-Lain')->where('bs_pl', 'PL')->get();
        foreach ($bll as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_bll += $sum_debit - $sum_credit;
        }
        $data_bll = array(
            'Nama' => 'Biaya Lain-Lain',
            'total_bll' => $sum_bll,
        );
        return $data_bll;
    }

    public function bpp_pk()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_bpp_pk = 0;
        $bpp_pk = Jurnal::where('Chart_Of_Account', 'Biaya PemelihA/Raan & Perbaikan - PerlengkA/Pan Kantor')->where('bs_pl', 'PL')->get();
        foreach ($bpp_pk as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_bpp_pk += $sum_debit - $sum_credit;
        }
        $data_bpp_pk = array(
            'Nama' => 'Biaya Pemeliharaan & Perbaikan - Perlengkapan Kantor',
            'total_bpp_pk' => $sum_bpp_pk,
        );
        return $data_bpp_pk;
    }

    public function bppn1()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_bppn1 = 0;
        $bppn1 = Jurnal::where('Chart_Of_Account', 'Hutang Pajak - PPN Keluaranan')->where('bs_pl', 'PL')->get();
        foreach ($bppn1 as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_bppn1 += $sum_debit - $sum_credit;
        }
        $data_bppn1 = array(
            'Nama' => 'Biaya PPn - 1%',
            'total_bppn1' => $sum_bppn1,
        );
        return $data_bppn1;
    }

    // public function briem()
    // {
    //     $sum_briem = 0;
    //     $briem = Jurnal::where('Chart_Of_Account', 'Hutang Pajak - PPN Keluaranan')->get();
    //     foreach ($briem as $x) {
    //         $ending_balance = $x->ending_balance;
    //         $sum_briem += $ending_balance;
    //     }
    //     $data_briem = array(
    //         'Nama' => 'Biaya PPn - 1%',
    //         'total_briem' => $sum_briem,
    //     );
    //     return $data_briem;
    // }

    public function btl()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_btl = 0;
        $btl = Jurnal::where('Chart_Of_Account', 'Biaya Tunjangan Lembur')->where('bs_pl', 'PL')->get();
        foreach ($btl as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_btl += $sum_debit - $sum_credit;
        }
        $data_btl = array(
            'Nama' => 'Biaya Tunjangan Lembur',
            'total_btl' => $sum_btl,
        );
        return $data_btl;
    }

    public function lskl()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_lskl = 0;
        $lskl = Jurnal::where('Chart_Of_Account', 'Laba (Rugi) Selisih Kurs Riil')->where('bs_pl', 'PL')->get();
        foreach ($lskl as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_lskl += $sum_debit - $sum_credit;
        }
        $data_lskl = array(
            'Nama' => 'Laba (Rugi) Selisih Kurs Riil',
            'total_lskl' => $sum_lskl,
        );
        return $data_lskl;
    }

    public function pll()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_pll = 0;
        $pll = Jurnal::where('Chart_Of_Account', 'PENDA/PATAN LAIN-LAIN')->where('bs_pl', 'PL')->get();
        foreach ($pll as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_pll += $sum_debit - $sum_credit;
        }
        $data_pll = array(
            'Nama' => 'Pendapatan Lain-lain',
            'total_pll' => $sum_pll,
        );
        return $data_pll;
    }

    public function pbb()
    {
        $sum_debit = 0;
        $sum_credit = 0;
        $sum_pbb = 0;
        $pbb = Jurnal::where('Chart_Of_Account', 'PendA/Patan Bunga Bank')->where('bs_pl', 'PL')->get();
        foreach ($pbb as $x) {
            $debit = $x->Debit;
            $credit = $x->Credit;
            $sum_debit += $debit;
            $sum_credit += $credit;
            $sum_pbb += $sum_debit - $sum_credit;
        }
        $data_pbb = array(
            'Nama' => 'Pendapatan Bunga Bank',
            'total_pbb' => $sum_pbb,
        );
        return $data_pbb;
    }


    public function prof_loss()
    {
        $penjualan = $this->penjualan();
        $hapok = $this->hapok();
        $potong_beli = $this->potongan_beli();

        $badumum_atk = $this->badmumum_atk();
        $badmumum_bp_pph21 = $this->badmumum_bp_pph21();
        $badmumum_bp_pph23 = $this->badmumum_bp_pph23();
        $badmumum_bp_pph4 = $this->badmumum_bp_pph4();
        $badmumum_dapur = $this->badmumum_dapur();
        $badmumum_la = $this->badmumum_la();
        $badmumum_materai = $this->badmumum_materai();
        $badmumum_pencetakan = $this->badmumum_pencetakan();
        $badmumum_jaspro = $this->badmumum_jaspro();
        $badmumum_manfee = $this->badmumum_manfee();
        $badmumum_ppbd = $this->badmumum_ppbd();
        $badmumum_tagin = $this->badmumum_tagin();
        $badmumum_tagtel = $this->badmumum_tagtel();
        $badmumum_transportasi = $this->badmumum_transportasi();
        $bdd__bp_pph23 = $this->bdd__bp_pph23();
        $bp_sewken = $this->bp_sewken();
        $bp_perker = $this->bp_perker();
        $bab = $this->bab();
        $bgu = $this->bgu();
        $bll = $this->bll();
        $bpp_pk = $this->bpp_pk();
        $bppn1 = $this->bppn1();
        // $briem = $this->briem();
        $btl = $this->btl();
        $lskl = $this->lskl();


        $laba_kotor = (($penjualan['total_penjualan'] + $hapok['total_hapok']) - $potong_beli['total_pot_beli']);
        $jumlah_beban_operasi = (
            ($badmumum_bp_pph21['total_bp_pph21'] +
                $badmumum_bp_pph23['total_bp_pph23'] +
                $badmumum_bp_pph4['total_bp_pph4'] +
                $badmumum_dapur['total_dapur'] +
                $badmumum_la['total_la'] +
                $badmumum_materai['total_materai'] +
                $badmumum_pencetakan['total_pencetakan'] +
                $badmumum_jaspro['total_jaspro'] +
                $badmumum_manfee['total_manfee'] +
                $badmumum_ppbd['total_ppbd'] +
                $badmumum_tagin['total_tagin'] +
                $badmumum_tagtel['total_tagtel'] +
                $badmumum_transportasi['total_transportasi'] +
                $bdd__bp_pph23['total_bdd__bp_pph23'] +
                $bp_sewken['total_bp_sewken'] +
                $bp_perker['total_bp_perker'] +
                $bab['total_bab'] +
                $bgu['total_bgu'] +
                $bll['total_bll'] +
                $bpp_pk['total_bpp_pk'] +
                $bppn1['total_bppn1'] +
                $btl['total_btl'] +
                $lskl['total_lskl'])
        );


        $pll = $this->pll();
        $pbb = $this->pbb();

        $jumlah_pendapatan_lain = (($pll['total_pll'] + $pbb['total_pbb']));
        $laba_rugi = (($laba_kotor - $jumlah_beban_operasi + $jumlah_pendapatan_lain));

        $fedora_30persen = ($laba_rugi * 30) / 100;
        $dicky_70persen = $laba_rugi - $fedora_30persen;

        $wages_and_salaries = (($bgu['total_bgu'] + $btl['total_btl']));
        $rime = (($bp_sewken['total_bp_sewken'] + $bpp_pk['total_bpp_pk']));
        $gae = (($wages_and_salaries - $rime - $bpp_pk['total_bpp_pk'] - $bab['total_bab'] - $badmumum_bp_pph21['total_bp_pph21'] - $badmumum_bp_pph23['total_bp_pph23'] - $badmumum_bp_pph4['total_bp_pph4']));

        $profit_loss = (($laba_kotor - $wages_and_salaries - $rime - $gae - $bpp_pk['total_bpp_pk'] - $bab['total_bab']) - $badmumum_bp_pph21['total_bp_pph21'] - $badmumum_bp_pph23['total_bp_pph23'] - $badmumum_bp_pph4['total_bp_pph4'] + $pll['total_pll']);


        return view(
            'jurnal.profloss.profloss',
            compact(
                'laba_kotor',
                'jumlah_beban_operasi',
                'penjualan',
                'hapok',
                'potong_beli',
                'badumum_atk',
                'badmumum_bp_pph21',
                'badmumum_bp_pph23',
                'badmumum_bp_pph4',
                'badmumum_dapur',
                'badmumum_la',
                'badmumum_materai',
                'badmumum_pencetakan',
                'badmumum_jaspro',
                'badmumum_manfee',
                'badmumum_ppbd',
                'badmumum_tagin',
                'badmumum_tagtel',
                'badmumum_transportasi',
                'bdd__bp_pph23',
                'bp_sewken',
                'bp_perker',
                'bab',
                'bgu',
                'bll',
                'bpp_pk',
                'bppn1',
                'btl',
                'lskl',
                'pll',
                'pbb',
                'jumlah_pendapatan_lain',
                'laba_rugi',
                'fedora_30persen',
                'dicky_70persen',
                'wages_and_salaries',
                'rime',
                'gae',
                'profit_loss'



            )
        );
    }
}
