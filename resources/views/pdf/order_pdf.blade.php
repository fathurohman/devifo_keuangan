<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link type="text/css" href="{{ public_path('argon') }}/css/nota.css" rel="stylesheet">

</head>

<body>
    <div  class="table-header">
        <table style="table-layout:fixed;">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td style="text-align: center">
                            <table style="text-align: center">
                                <tr>
                                    <td colspan="3" style="text-align: center;">
                                        <img style="width: 80%" src="{{ public_path('argon') }}/img/devifo.jpg">
                                    </td>
                                </tr>
                                <tbody>
                                    <tr>
                                        <td colspan="3" style="text-align: center;font-size: 9pt">
                                            Jl. Cibanteng Agathis, Cihideung Ilir, Kec. Ciampea, Kabupaten Bogor, Jawa Barat 16620
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="text-align: center;font-size: 9pt">
                                            Telp.0813-7774-7001
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </td>

                        <td style="text-align: right">
                            <table style="text-align: right">
                                <tr>
                                    <td colspan="3" style="text-align: right;">Bogor, {{ Carbon\Carbon::now()->format('d F Y')}}</td>
                                </tr>
                                <tbody>
                                    <tr>
                                        <td colspan="3" style="text-align: right;height: 50px;">Kepada Yth.</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%">Nama</td>
                                        <td style="width: 1%">:</td>
                                        <td style="width: 10%"><b>{{ $data['order']->nama_pembeli}}</b></td>
                                    </tr>
                                    <tr>
                                        <td>No.HP</td>
                                        <td>:</td>
                                        <td><b>{{ $data['order']->no_pembeli}}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>

                    </tr>
            </tbody>
        </table>
    </div><br>
    NOTA No : <b>{{ $data['order']->kode_nota}}</b>
                        <div  class="table-request">
                            <table border="1" style="table-layout:fixed;">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;height: 30px;">No</th>
                                        <th style="width: 15%;">Kode</th>
                                        <th style="width: 35%;">Nama</th>
                                        <th style="width: 20%;">Harga</th>
                                        <th style="width: 15%;">Jumlah</th>
                                        <th style="width: 50%;">Total</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['data'] as $index=>$x)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td style="height: 30px"> {{ $x->barangs->kode_barang }} </td>
                                            <td>{{ $x->barangs->nama_barang }} </td>
                                            <td> Rp.{{ number_format((float) $x->barangs->harga_barang) }}</td>
                                            <td>{{ $x->jumlah}}</td>
                                            <td>Rp.{{ number_format((float) $x->total) }}</td>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" style="text-align: center;font-size: 12pt;font-weight: 700;height: 40px;">
                                            TOTAL JUMLAH
                                        </td>
                                        <td style="font-size: 15pt;font-weight: 700">
                                            Rp.{{ number_format((float) $data['sum']) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div  class="table-header">
                            <table style="table-layout:fixed;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        {{-- <th>2</th> --}}
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td style="text-align: center">Tanda Terima,</td>
                                            {{-- <td style="font-size: 8pt;"><br>
                                                <p style="text-align: left">Barang Yang Sudah Di beli tidak dapat di tukar kembali</p></td> --}}
                                            <td style="text-align: center">Hormat Kami,</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div><br>
</body>

</html>
