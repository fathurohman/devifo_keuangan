<table>
    <thead>
        <tr>
            <th> </th>
            <th>Sum</th>
        </tr>
    </thead>
    <tbody style="color: black">
        <tr>
            <td><b>Aktiva Lancar</b></td>
            <td></td>
        </tr>
        <tr>
            <td>BCA SIGMA IDR- 3728-888-557</td>
            <td>{{number_format((float) $bca_idr['total_bca_idr'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>BCA SIGMA USD- 3728-888-506</td>
            <td>{{number_format((float) $bca_usd['total_bca_usd'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Kas Kecil Kantor Pusat - IDR</td>
            <td>{{number_format((float) $kas_kecil['total_kas_kecil'], 2, '.', ',')}}</td>
        </tr>
        <tr style="background: #96D2D9">
            <td><b>Jumlah Cash</b></td>
            <td><b>{{number_format((float) $jumlah_kas, 2, '.', ',')}}</b></td>
        </tr>
        <tr>
            <td>Piutang Dagang - IDR</td>
            <td>{{number_format((float) $piutang_dagang['total_piutang_dagang'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Piutang Pemegang Saham</td>
            <td>{{number_format((float) $piutang_saham['total_piutang_saham'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Uang Muka Pembelian - IDR</td>
            <td>{{number_format((float) $dp_pembelian['total_dp_pembelian'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Uang Muka Kerja Karyawan - IDR</td>
            <td>{{number_format((float) $dp_karyawan['total_dp_karyawan'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Pajak Dibayar Dimuka - PPH 23</td>
            <td>{{number_format((float) $dp_pph['total_dp_pph'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Biaya Dibayar Dimuka Fasilitas</td>
            <td>{{number_format((float) $dimuka_gedung['total_dimuka_gedung'], 2, '.', ',')}}</td>
        </tr>
        <tr style="background: #96D2D9">
            <td><b>Jumlah Aktiva Lancar</b></td>
            <td><b>{{number_format((float) $jumlah_aktiva_kas, 2, '.', ',')}}</b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>Aktiva Lancar</b></td>
            <td></td>
        </tr>
        <tr>
            <td>Aktiva Jakarta - Peralatan Kerja</td>
            <td>{{number_format((float) $peralatan_kerja['total_peralatan_kerja'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Akumulasi Penyusutan - Peralatan Kerja</td>
            <td>{{number_format((float) $penyusutan_peralatan_kerja['total_penyusutan_peralatan_kerja'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr style="background: #96D2D9">
            <td><b>Jumlah Aktiva Tetap</b></td>
            <td><b>{{number_format((float) $jumlah_aktiva_tetap, 2, '.', ',')}}</b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr style="background: #96D2D9">
            <td><b>Total Aktiva</b></td>
            <td><b>{{number_format((float) $total_aktiva, 2, '.', ',')}}</b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>Kewajiban dan Ekuitas </b></td>
            <td></td>
        </tr>
        <tr>
            <td><b>Kewajiban Lancar</b></td>
            <td></td>
        </tr>
        <tr>
            <td>Hutang Afiliasi - DUI</td>
            <td>{{number_format((float) $hutang_afiliasi['total_hutang_afiliasi'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Hutang Afiliasi - Fedora</td>
            <td>{{number_format((float) $afiliasi_fedora['total_afiliasi_fedora'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Hutang Dagang - IDR</td>
            <td>{{number_format((float) $hutang_dagang['total_hutang_dagang'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Hutang Pihak Ketiga</td>
            <td>{{number_format((float) $hutang_ketiga['total_hutang_ketiga'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Hutang Pajak - PPh 21</td>
            <td>{{number_format((float) $hutang_pph_21['total_hutang_pph_21'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Hutang Pajak - PPh 23</td>
            <td>{{number_format((float) $hutang_pph_23['total_hutang_pph_23'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Hutang Pajak - PPh 4 (2)</td>
            <td>{{number_format((float) $hutang_pph_4['total_hutang_pph_4'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Hutang PPn Kurang Bayar</td>
            <td>{{number_format((float) $hutang_ppn_kurbay['total_hutang_ppn_kurbay'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Uang Muka Penjualan - IDR</td>
            <td>{{number_format((float) $dp_penjualan['dp_penjualan'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Uang Muka Setoran Modal</td>
            <td>{{number_format((float) $dp_setoran_modal['dp_setoran_modal'], 2, '.', ',')}}</td>
        </tr>
        <tr style="background: #96D2D9">
            <td><b>Jumlah Kewajiban Lancar</b></td>
            <td><b>{{number_format((float) $jumlah_kewajiban_lancar, 2, '.', ',')}}</b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><b>Ekuitas</b></td>
            <td></td>
        </tr>
        <tr>
            <td>Modal Disetor</td>
            <td>{{number_format((float) $modal_disetor['modal_disetor'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Laba/Rugi ditahan</td>
            <td>{{number_format((float) $laba_ditahan['laba_ditahan'], 2, '.', ',')}}</td>
        </tr>
        <tr>
            <td>Laba/Rugi ditahun berjalan</td>
            <td>0</td>
        </tr>
        <tr>
            <td>Deviden</td>
            <td>{{number_format((float) $cadangan_dividen['cadangan_dividen'], 2, '.', ',')}}</td>
        </tr>
        <tr style="background: #96D2D9">
            <td><b>Jumlah Ekuitas</b></td>
            <td><b>{{number_format((float) $jumlah_ekuitas, 2, '.', ',')}}</b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr style="background: yellow">
            <td><b>Total Kewajiban dan Ekuitas </b></td>
            <td><b>{{number_format((float) $kewajiban_ekuitas, 2, '.', ',')}}</b></td>
        </tr>


        <tr>
        </tr>
    </tbody>
</table>
