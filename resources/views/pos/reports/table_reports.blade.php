
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Costumer</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga Barang</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Total</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sum =0;
                            @endphp
                            @foreach ($data as $c)
                                <tr>
                                    <td>{{ Carbon\Carbon::parse($c->created_at)->format('d-m-Y')  }}</td>
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
                            @endforeach
                            <tr>
                                <td colspan="6"></td>
                            </tr>
                            <tr>
                                <td style="font-size: 12pt;font-weight: 700;text-align: center" colspan="3"> TOTAL </td>
                                <td style="font-size: 12pt;font-weight: 700;text-align: center" colspan="3">{{ number_format((float) $sum) }}</td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
