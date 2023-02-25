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
        @foreach ($data as $index => $c)

            <tr>
                <td style="text-align: center">{{ Carbon\Carbon::parse($c->created_at)->format('d/m/Y')  }}</td>
                <td style="text-align: center">{{ $c->order->nama_pembeli }}</td>
                <td style="text-align: center">{{ $c->barangs->nama_barang }}</td>
                <td style="text-align: left">Rp. {{ number_format((float) $c->barangs->harga_barang) }}</td>
                <td style="text-align: center">{{ $c->jumlah}}</td>
                <td style="text-align: left">Rp. {{ number_format((float) $c->total)}}</td>
            </tr>
            {{-- <tr>
                <td colspan="3" style="font-size: 12pt;font-weight: 700;text-align: center">
                    Total
                </td>
                <td colspan="3" style="font-size: 12pt;font-weight: 700;text-align: right">
                    {{ $c->t += $c->total }}
                </td>
            </tr> --}}
        @endforeach
            <tr>
                <td colspan="6"></td>
            </tr>
            <tr>
                <td style="font-size: 15pt;font-weight: 700;text-align: center" colspan="3"> TOTAL </td>
                <td style="font-size: 15pt;font-weight: 700;text-align: center" colspan="3">Rp. {{ number_format((float) $sum)}}</td>

            </tr>

    </tbody>
</table>
