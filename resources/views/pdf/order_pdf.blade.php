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
                        <td style="width: 65%">
                            <table>
                                <tr>
                                    <td colspan="3">
                                        <img style="width: 55%" src="{{ public_path('argon') }}/img/notalogo.png">
                                        <div style="font-size: 8pt;margin-top: 8px"><b> Jl. Cibanteng Agathis, Cihideung Ilir, Kec. Ciampea, Kab. Bogor </b></div>
                                    </td>
                                </tr>
                                    <tr>
                                        <td colspan="3" style="font-size: 8pt">

                                        </td>
                                    </tr>
                            </table>
                        </td>

                        <td style="text-align: right;font-size: 8pt"><b>
                            <table style="text-align: right">
                                {{-- <tr>
                                    <td style="text-align: right;">
                                        0251-8471300 <img width="6%" src="{{ public_path('argon') }}/img/small/small_tlp.png">
                                    </td>
                                </tr> --}}
                                <tr>
                                    <td style="text-align: right;">
                                        0813-7774-7001 <img width="6%" src="{{ public_path('argon') }}/img/small/small_wa.png">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">
                                        devifo.invitation <img width="6%" src="{{ public_path('argon') }}/img/small/small_instagram.png">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">
                                        devifo.com <img width="6%" src="{{ public_path('argon') }}/img/small/small_web.png">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: right;">
                                        devifo.official@gmail.com <img width="6%" src="{{ public_path('argon') }}/img/small/small_gmail.png">
                                    </td>
                                </tr>
                                </tr>
                            </table>
                        </b>
                        </td>

                    </tr>
            </tbody>
        </table>
    </div><br>
    <table style="width: 100%;">
        <tr>
            <td>
               <b> Costumer </b>  &nbsp;&nbsp;:  {{ $data['order']->nama_pembeli}}<br>
    <b>No Whatsapp</b> :  {{ $data['order']->no_pembeli}}<br>
            </td>
            <td></td>
            <td style="text-align: right"><b>Tanggal</b> : {{ Carbon\Carbon::now()->format('d F Y')}}</td>
        </tr>
    </table>

                        <div class="table-request">
                            <table border="1" style="table-layout:fixed;">
                                <thead>
                                    <tr style="background-color: #000000;color: white">
                                        <th style="width: 15%;height: 30px;">QTY</th>
                                        <th style="width: 35%;">Nama Barang</th>
                                        <th style="width: 20%;">Harga</th>
                                        <th style="width: 50%;">Total</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['data'] as $index=>$x)
                                        <tr>
                                            <td style="height: 20px;">{{ $x->jumlah}}</td>
                                            <td>{{ $x->barangs->nama_barang }} </td>
                                            <td> Rp.{{ number_format((float) $x->barangs->harga_barang) }}</td>
                                            <td>Rp.{{ number_format((float) $x->total) }}</td>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td style="height: 20px;"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                    <tr>
                                        <td colspan="3" style="text-align: center;font-size: 12pt;font-weight: 700;height: 40px;">
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
                                            <td><b>
                                            <table>
                                                <tr>
                                                    <td>No. Rek.</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>AN</td>
                                                    <td>:</td>
                                                    <td>AFIF RAFYAN</td>
                                                </tr>
                                                <tr>
                                                    <td>BCA</td>
                                                    <td>:</td>
                                                    <td>1740334723</td>
                                                </tr>
                                                <tr>
                                                    <td>Mandiri</td>
                                                    <td>:</td>
                                                    <td>1330014784664</td>
                                                </tr>
                                            </table>
                                            </b>
                                            </td>
                                            {{-- <td style="font-size: 8pt;"><br>
                                                <p style="text-align: left">Barang Yang Sudah Di beli tidak dapat di tukar kembali</p></td> --}}
                                            <td style="text-align: center"><b>Hormat Kami,</b>
                                            <br><br><br><br>
                                            {{-- ( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ) --}}
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div><br>
</body>

</html>
