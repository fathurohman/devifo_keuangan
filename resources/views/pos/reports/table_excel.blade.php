<table>
    <thead>
        <tr>
            <td colspan="6" style="font-size: 15pt;font-weight: 700;text-align: center">LAPORAN TRANSAKSI</td>

        </tr>
        <tr>
            <td colspan="6" style="font-size: 12pt;font-weight: 600;text-align: center">
                {{ Carbon\Carbon::parse($start)->format('d F Y') }} s/d {{ Carbon\Carbon::parse($end)->format('d F Y') }}</td>

        </tr>
        <tr>
            <th width="150px" scope="col" style="font-size: 12pt;font-weight: 700;text-align: center">TANGGAL</th>
            <th width="250px" scope="col" style="font-size: 12pt;font-weight: 700;text-align: center">NAMA COSTUMER</th>
            <th width="300px" scope="col" style="font-size: 12pt;font-weight: 700;text-align: center">NAMA BARANG</th>
            <th width="150px" scope="col" style="font-size: 12pt;font-weight: 700;text-align: center">HARGA BARANG</th>
            <th width="150px" scope="col" style="font-size: 12pt;font-weight: 700;text-align: center">QTY</th>
            <th width="300px" scope="col" style="font-size: 12pt;font-weight: 700;text-align: center">TOTAL</th>
        </tr>
    </thead>
    <tbody>
        @php
        $sum =0;
        @endphp
        @foreach ($data as $c)
            <tr>
                <td style="text-align: center">{{ Carbon\Carbon::parse($c->created_at)->format('d/m/Y')  }}</td>
                <td>{{ $c->nama_pembeli }}</td>
                <tr>
                    @php
                        $co = App\Model\child_order::where('order_id', $c->id)->get();


                    @endphp
                    @foreach ($co as $x)
                    @php
                    $x->totals = $x->barangs->harga_barang * $x->jumlah;
                         $sum += $x->totals;
                    @endphp
                    <tr>
                        <td></td>
                        <td></td>
                    <td>{{ $x->barangs->nama_barang }}</td>
                    <td>Rp. {{ number_format((float) $x->barangs->harga_barang) }}</td>
                    <td>{{ $x->jumlah }}</td>
                    <td>Rp. {{ number_format((float) $x->total)}}</td>
                    <td></td>
                    </tr>
                    @endforeach

                </tr>
            </tr>
        @endforeach
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td style="font-size: 15pt;font-weight: 700;text-align: center" colspan="3"> TOTAL </td>
                <td style="font-size: 15pt;font-weight: 700;text-align: center" colspan="3">{{ number_format((float) $sum) }}</td>

            </tr>

    </tbody>
</table>
