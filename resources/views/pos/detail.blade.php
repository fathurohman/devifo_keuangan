<a target="_parent" href="{{ route('print.order' , $order->id)}}" class="btn btn-sm btn-success" > <i class="fas fa-print"></i> Print </a>
<br>
<div style="color: black">
    <p>
        Nama Pembeli :  {{ $order->nama_pembeli }}
     </p>
     <p>
        No Pembeli :  {{ $order->no_pembeli }}
     </p>
    <p>
        Created By :  {{ $order->users->name }}
     </p>
</div>

<div class="mx-3">
    <div class="table-responsive">
        <table id="myTable" class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $x)
                    <tr>
                        <td> {{ $x->barangs->kode_barang }} </td>
                        <td>{{ $x->barangs->nama_barang }} </td>
                        <td> Rp. {{ number_format((float) $x->barangs->harga_barang) }}</td>
                        <td>{{ $x->jumlah}}</td>
                        <td>Rp. {{ number_format((float) $x->total) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="text-align: center;font-size: 12pt;font-weight: 700">
                        TOTAL JUMLAH
                    </td>
                    <td style="font-size: 15pt;font-weight: 700">
                        Rp. {{ number_format((float) $sum) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
