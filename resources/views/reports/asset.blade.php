<table>
    <tr>
        <th colspan="3">
            <h3>PT Sigma Global Makmur</h3>
        </th>
    </tr>
    <tr>
        <th colspan="3">Asset Report</th>
    </tr>
    <tr>
        <th colspan="3">{{ $from }} s/d {{ $to }}</th>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th style="background-color:#6DCCEC">No</th>
            <th style="background-color:#6DCCEC">Trans Date</th>
            <th style="background-color:#6DCCEC">Nama Barang</th>
            <th style="background-color:#6DCCEC">Harga Barang</th>
            <th style="background-color:#6DCCEC">Barang Sudah Dipakai PerBulan</th>
            <th style="background-color:#6DCCEC">Harga Setelah Depresiasi</th>
            <th style="background-color:#6DCCEC">Detail</th>
            <th style="background-color:#6DCCEC">Penggunaan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $x )

        @php
                    // ->join('jns_akun', 'jns_akun.id', '=' , 'assets.coa_id')
                    // ->join('nama_barang', 'nama_barang.id', '=' , 'assets.barang_id')
                    // ->select('assets.*','nama_barang.nama_barang','jns_akun.jns_trans')
            $spek = DB::table('assets_spek')->where('assets_id',$x->id)->get();
            $afterdespresiasi = DB::table('assets')->where('induk_id', $x->id)->orderBy('id', 'desc')->limit('1')->get();
            $cek = DB::table('assets')->where('induk_id', $x->id)->count();

            $own = Carbon\Carbon::parse($x->trans_date)->format('Y-m-d');
            $now = Carbon\Carbon::now()->format('Y-m-d');
            $s  = date_create($own);
            $d  = date_create($now);

            $selisih_bulan = date_diff($s,$d);
            if($selisih_bulan->y >= 0){
                $tahun = $selisih_bulan->y * 12;
            }else{
                $tahun = 0;
            }

            $current_mount = $selisih_bulan->m + $tahun + 1;
        @endphp

            <tr>
                <td>{{$index+1}}</td>
                <td>{{$x->trans_date}}</td>
                <td>{{$x->barang->nama_barang}}</td>
                <td>{{number_format($x->debit, 2) }}</td>
                @if($selisih_bulan->m > 0)
                    <td>{{$current_mount }}</td>
                @else
                    @if ($x->barang->elektronik == 1)
                        <td>{{$current_mount }}</td>
                    @else
                        <td>-</td>
                    @endif

                @endif

                @foreach ($afterdespresiasi as $ad)
                        <td>{{number_format($ad->ending_balance, 2) }}</td>
                @endforeach
                @if ($cek)

                @else
                    <td>-</td>
                @endif

                @foreach ($spek as $sp)
                <td>{{$sp->detail}}</td>
                <td>{{$sp->penggunaan}}</td>
            @endforeach

            </tr>
        @endforeach
    </tbody>
</table>
