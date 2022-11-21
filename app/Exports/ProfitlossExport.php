<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ProfitlossExport implements FromView, ShouldAutoSize, WithStrictNullComparison
{
    protected $from, $to, $laba_kotor, $jumlah_beban_operasi, $penjualan, $hapok, $potong_beli, $badumum_atk, $badmumum_bp_pph21, $badmumum_bp_pph23, $badmumum_bp_pph4, $badmumum_dapur, $badmumum_la, $badmumum_materai,$badmumum_pencetakan, $badmumum_jaspro, $badmumum_manfee, $badmumum_ppbd, $badmumum_tagin, $badmumum_tagtel,
    $badmumum_transportasi, $bdd__bp_pph23, $bp_sewken, $bp_perker, $bab, $bgu, $bll, $bpp_pk, $bppn1, $btl, $lskl, $pll, $pbb, $jumlah_pendapatan_lain, $laba_rugi, $fedora_30persen, $dicky_70persen, $wages_and_salaries, $rime, $gae, $profit_loss;

    function __construct($from,
    $to,
    $laba_kotor,
    $jumlah_beban_operasi,
    $penjualan,
    $hapok,
    $potong_beli,
    $badumum_atk,
    $badmumum_bp_pph21,
    $badmumum_bp_pph23,
    $badmumum_bp_pph4,
    $badmumum_dapur,
    $badmumum_la,
    $badmumum_materai,
    $badmumum_pencetakan,
    $badmumum_jaspro,
    $badmumum_manfee,
    $badmumum_ppbd,
    $badmumum_tagin,
    $badmumum_tagtel,
    $badmumum_transportasi,
    $bdd__bp_pph23,
    $bp_sewken,
    $bp_perker,
    $bab,
    $bgu,
    $bll,
    $bpp_pk,
    $bppn1,
    $btl,
    $lskl,
    $pll,
    $pbb,
    $jumlah_pendapatan_lain,
    $laba_rugi,
    $fedora_30persen,
    $dicky_70persen,
    $wages_and_salaries,
    $rime,
    $gae,
    $profit_loss)
    {
    $this->from = $from;
    $this->to = $to;
    $this->laba_kotor = $laba_kotor;
    $this->jumlah_beban_operasi = $jumlah_beban_operasi;
    $this->penjualan = $penjualan;
    $this->hapok = $hapok;
    $this->potong_beli = $potong_beli;
    $this->badumum_atk = $badumum_atk;
    $this->badmumum_bp_pph21 = $badmumum_bp_pph21;
    $this->badmumum_bp_pph23 = $badmumum_bp_pph23;
    $this->badmumum_bp_pph4 = $badmumum_bp_pph4;
    $this->badmumum_dapur = $badmumum_dapur;
    $this->badmumum_la = $badmumum_la;
    $this->badmumum_materai = $badmumum_materai;
    $this->badmumum_pencetakan = $badmumum_pencetakan;
    $this->badmumum_jaspro = $badmumum_jaspro;
    $this->badmumum_manfee = $badmumum_manfee;
    $this->badmumum_ppbd = $badmumum_ppbd;
    $this->badmumum_tagin = $badmumum_tagin;
    $this->badmumum_tagtel = $badmumum_tagtel;
    $this->badmumum_transportasi = $badmumum_transportasi;
    $this->bdd__bp_pph23 = $bdd__bp_pph23;
    $this->bp_sewken = $bp_sewken;
    $this->bp_perker = $bp_perker;
    $this->bab = $bab;
    $this->bgu = $bgu;
    $this->bll = $bll;
    $this->bpp_pk = $bpp_pk;
    $this->bppn1 = $bppn1;
    $this->btl = $btl;
    $this->lskl = $lskl;
    $this->pll = $pll;
    $this->pbb = $pbb;
    $this->jumlah_pendapatan_lain = $jumlah_pendapatan_lain;
    $this->laba_rugi = $laba_rugi;
    $this->fedora_30persen = $fedora_30persen;
    $this->dicky_70persen = $dicky_70persen;
    $this->wages_and_salaries = $wages_and_salaries;
    $this->rime = $rime;
    $this->gae = $gae;
    $this->profit_loss = $profit_loss;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $from = $this->from;
        $to = $this->to;
        $laba_kotor = $this->laba_kotor;
        $jumlah_beban_operasi = $this->jumlah_beban_operasi;
        $penjualan = $this->penjualan;
        $hapok = $this->hapok;
        $potong_beli = $this->potong_beli;
        $badumum_atk = $this->badumum_atk;
        $badmumum_bp_pph21 = $this->badmumum_bp_pph21;
        $badmumum_bp_pph23 = $this->badmumum_bp_pph23;
        $badmumum_bp_pph4 = $this->badmumum_bp_pph4;
        $badmumum_dapur = $this->badmumum_dapur;
        $badmumum_la = $this->badmumum_la;
        $badmumum_materai = $this->badmumum_materai;
        $badmumum_pencetakan = $this->badmumum_pencetakan;
        $badmumum_jaspro = $this->badmumum_jaspro;
        $badmumum_manfee = $this->badmumum_manfee;
        $badmumum_ppbd = $this->badmumum_ppbd;
        $badmumum_tagin = $this->badmumum_tagin;
        $badmumum_tagtel = $this->badmumum_tagtel;
        $badmumum_transportasi = $this->badmumum_transportasi;
        $bdd__bp_pph23 = $this->bdd__bp_pph23;
        $bp_sewken = $this->bp_sewken;
        $bp_perker = $this->bp_perker;
        $bab = $this->bab;
        $bgu = $this->bgu;
        $bll = $this->bll;
        $bpp_pk = $this->bpp_pk;
        $bppn1 = $this->bppn1;
        $btl = $this->btl;
        $lskl = $this->lskl;
        $pll = $this->pll;
        $pbb = $this->pbb;
        $jumlah_pendapatan_lain = $this->jumlah_pendapatan_lain;
        $laba_rugi = $this->laba_rugi;
        $fedora_30persen = $this->fedora_30persen;
        $dicky_70persen = $this->dicky_70persen;
        $wages_and_salaries = $this->wages_and_salaries;
        $rime = $this->rime;
        $gae = $this->gae;
        $profit_loss = $this->profit_loss;



        return view('jurnal.profloss.export_profloss', [
    'from' => $from,
    'to' => $to,
    'laba_kotor' => $laba_kotor,
    'jumlah_beban_operasi' => $jumlah_beban_operasi,
    'penjualan' => $penjualan,
    'hapok' => $hapok,
    'potong_beli' => $potong_beli,
    'badumum_atk' => $badumum_atk,
    'badmumum_bp_pph21' => $badmumum_bp_pph21,
    'badmumum_bp_pph23' => $badmumum_bp_pph23,
    'badmumum_bp_pph4' => $badmumum_bp_pph4,
    'badmumum_dapur' => $badmumum_dapur,
    'badmumum_la' => $badmumum_la,
    'badmumum_materai' => $badmumum_materai,
    'badmumum_pencetakan' => $badmumum_pencetakan,
    'badmumum_jaspro' => $badmumum_jaspro,
    'badmumum_manfee' => $badmumum_manfee,
    'badmumum_ppbd' => $badmumum_ppbd,
    'badmumum_tagin' => $badmumum_tagin,
    'badmumum_tagtel' => $badmumum_tagtel,
    'badmumum_transportasi' => $badmumum_transportasi,
    'bdd__bp_pph23' => $bdd__bp_pph23,
    'bp_sewken' => $bp_sewken,
    'bp_perker' => $bp_perker,
    'bab' => $bab,
    'bgu' => $bgu,
    'bll' => $bll,
    'bpp_pk' => $bpp_pk,
    'bppn1' => $bppn1,
    'btl' => $btl,
    'lskl' => $lskl,
    'pll' => $pll,
    'pbb' => $pbb,
    'jumlah_pendapatan_lain' => $jumlah_pendapatan_lain,
    'laba_rugi' => $laba_rugi,
    'fedora_30persen' => $fedora_30persen,
    'dicky_70persen' => $dicky_70persen,
    'wages_and_salaries' => $wages_and_salaries,
    'rime' => $rime,
    'gae' => $gae,
    'profit_loss' => $profit_loss
        ]);
    }

}
