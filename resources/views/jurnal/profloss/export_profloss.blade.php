<table>
    <tr>
        <th colspan="3">
            <h3>PT Sigma Global Makmur</h3>
        </th>
    </tr>
    <tr>
        <th colspan="3">Profitloss Report</th>
    </tr>
    <tr>
        <th colspan="3">{{ $from }} s/d {{ $to }}</th>
    </tr>
</table>

<table>

        <tr>
            <th></th>
            <th>Sum</th>
        </tr>


        <tr>
            <td>{{$penjualan['Nama']}}</td>
            <td>{{number_format( $penjualan['total_penjualan'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$hapok['Nama']}}</td>
            <td>{{number_format( $hapok['total_hapok'], 2) }}</td>
        </tr>
        <tr>
            <td>{{$potong_beli['Nama']}}</td>
            <td>{{number_format( $potong_beli['total_pot_beli'], 2)}}</td>
        </tr>
        <tr style="background-color: #96D2D9">
            <td><b>LABA KOTOR</b></td>
            <td><b>{{number_format( $laba_kotor, 2)}}</b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Beban Operasi</td>
            <td> </td>
        </tr>
        <tr>
            <td>{{$badumum_atk['Nama']}}</td>
            <td>{{number_format( $badumum_atk['total_atk'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$badmumum_bp_pph21['Nama']}}</td>
            <td>{{number_format( $badmumum_bp_pph21['total_bp_pph21'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$badmumum_bp_pph23['Nama']}}</td>
            <td>{{number_format( $badmumum_bp_pph23['total_bp_pph23'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$badmumum_bp_pph4['Nama']}}</td>
            <td>{{number_format( $badmumum_bp_pph4['total_bp_pph4'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$badmumum_dapur['Nama']}}</td>
            <td>{{number_format( $badmumum_dapur['total_dapur'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$badmumum_la['Nama']}}</td>
            <td>{{number_format( $badmumum_la['total_la'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$badmumum_materai['Nama']}}</td>
            <td>{{number_format( $badmumum_materai['total_materai'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$badmumum_pencetakan['Nama']}}</td>
            <td>{{number_format( $badmumum_pencetakan['total_pencetakan'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$badmumum_jaspro['Nama']}}</td>
            <td>{{number_format( $badmumum_jaspro['total_jaspro'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$badmumum_manfee['Nama']}}</td>
            <td>{{number_format( $badmumum_manfee['total_manfee'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$badmumum_ppbd['Nama']}}</td>
            <td>{{number_format( $badmumum_ppbd['total_ppbd'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$badmumum_tagin['Nama']}}</td>
            <td>{{number_format( $badmumum_tagin['total_tagin'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$badmumum_tagtel['Nama']}}</td>
            <td>{{number_format( $badmumum_tagtel['total_tagtel'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$badmumum_transportasi['Nama']}}</td>
            <td>{{number_format( $badmumum_transportasi['total_transportasi'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$bdd__bp_pph23['Nama']}}</td>
            <td>{{number_format( $bdd__bp_pph23['total_bdd__bp_pph23'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$bp_sewken['Nama']}}</td>
            <td>{{number_format( $bp_sewken['total_bp_sewken'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$bp_perker['Nama']}}</td>
            <td>{{number_format( $bp_perker['total_bp_perker'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$bab['Nama']}}</td>
            <td>{{number_format( $bab['total_bab'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$bgu['Nama']}}</td>
            <td>{{number_format( $bgu['total_bgu'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$bll['Nama']}}</td>
            <td>{{number_format( $bll['total_bll'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$bpp_pk['Nama']}}</td>
            <td>{{number_format( $bpp_pk['total_bpp_pk'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$bppn1['Nama']}}</td>
            <td>{{number_format( $bppn1['total_bppn1'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$btl['Nama']}}</td>
            <td>{{number_format( $btl['total_btl'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$lskl['Nama']}}</td>
            <td>{{number_format( $lskl['total_lskl'], 2)}}</td>
        </tr>
        <tr style="background-color: #96D2D9">
            <td><b>Jumlah Beban Operasi</b></td>
            <td><b>{{number_format( $jumlah_beban_operasi, 2)}}</b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>Pendapatan Lain"</b></td>
            <td></td>
        </tr>
        <tr>
            <td>{{$pll['Nama']}}</td>
            <td>{{number_format( $pll['total_pll'], 2)}}</td>
        </tr>
        <tr>
            <td>{{$pbb['Nama']}}</td>
            <td>{{number_format( $pbb['total_pbb'], 2)}}</td>
        </tr>
        <tr style="background-color: #96D2D9">
            <td><b>Jumlah Pendapatan Lain" </b></td>
            <td><b>{{number_format( $jumlah_pendapatan_lain, 2)}}</b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>Laba/Rugi</b></td>
            <td>{{number_format( $laba_rugi, 2)}}</td>
        </tr>
        <tr>
            <td>Pembagian Laba :</td>
            <td></td>
        </tr>
        <tr>
            <td>  Ibu Fedora 30%</td>
            <td>{{number_format( $fedora_30persen, 2)}}</td>
        </tr>
        <tr>
            <td>  Bp Dicky 70%</td>
            <td>{{number_format( $dicky_70persen, 2)}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
         <tr>
            <td>SALES</td>
            <td>{{number_format( $penjualan['total_penjualan'], 2)}}</td>
        </tr>
        <tr>
            <td>HPP</td>
            <td>{{number_format( $hapok['total_hapok'], 2) }}</td>
        </tr>
        <tr>
            <td>LABA KOTOR</td>
            <td>{{number_format( $potong_beli['total_pot_beli'], 2)}}</td>
        </tr>

        <tr>
            <td>Wages and Salaries</td>
            <td>{{number_format( $wages_and_salaries, 2)}}</td>
        </tr>
        <tr>
            <td>Rent,Insurance,Manintenance Expense</td>
            <td>{{number_format( $rime, 2)}}</td>
        </tr>
        <tr>
            <td>General and Administration Expenses</td>
            <td>{{number_format( $gae, 2)}}</td>
        </tr>
         <tr>
            <td>Depreciation Aset Expense</td>
            <td>{{number_format( $bpp_pk['total_bpp_pk'], 2)}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td> Interest Income</td>
            <td> {{number_format( $pll['total_pll'], 2)}}</td>
        </tr>
        <tr>
            <td> Rental Income</td>
            <td></td>
        </tr>
        <tr>
            <td> Other expense</td>
            <td>{{number_format( $bab['total_bab'], 2)}}</td>
        </tr>
        <tr>
            <td> Income Taxes</td>
            <td></td>
        </tr>
        <tr>
            <td> Payroll Taxes 21</td>
            <td>{{number_format( $badmumum_bp_pph21['total_bp_pph21'], 2)}}</td>
        </tr>
        <tr>
            <td> Other Taxes- 23</td>
            <td>{{number_format( $badmumum_bp_pph23['total_bp_pph23'], 2)}}</td>
        </tr>
        <tr>
            <td> Other Taxes- 4(2) and UMKM Final </td>
            <td>{{number_format( $badmumum_bp_pph4['total_bp_pph4'], 2)}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr style="background-color: yellow">
            <td><b>Profit and loss</b></td>
            <td><b>{{number_format( $profit_loss, 2)}}</b></td>
        </tr>


</table>
