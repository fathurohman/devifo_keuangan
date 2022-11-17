@extends('layouts.app', ['activePage' => 'Neraca'])
@push('css')
    <link href="{{ asset('argon') }}/datatable/datatables.min.css" rel="stylesheet">
@endpush
@section('content')
    @include('users.partials.header', [
        'class' => 'col-lg-7',
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Neraca</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                    </div>
                    <div class="mx-3">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col"> </th>
                                        <th scope="col">Sum</th>
                                    </tr>
                                </thead>
                                <tbody style="color: black">
                                    <tr>
                                        <td><b>Aktiva Lancar</b></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>BCA SIGMA IDR- 3728-888-557</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>BCA SIGMA USD- 3728-888-506</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Kas Kecil Kantor Pusat - IDR</td>
                                        <td>0</td>
                                    </tr>
                                    <tr style="background: blue">
                                        <td><b>Jumlah Cash</b></td>
                                        <td><b>0</b></td>
                                    </tr>
                                    <tr>
                                        <td>Piutang Dagang - IDR</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Piutang Pemegang Saham</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Uang Muka Pembelian - IDR</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Uang Muka Kerja Karyawan - IDR</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Pajak Dibayar Dimuka - PPH 23</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Biaya Dibayar Dimuka Fasilitas</td>
                                        <td>0</td>
                                    </tr>
                                    <tr style="background: blue">
                                        <td><b>Jumlah Aktiva Lancar</b></td>
                                        <td><b>0</b></td>
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
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Akumulasi Penyusutan - Peralatan Kerja</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr style="background: blue">
                                        <td><b>Jumlah Aktiva Tetap</b></td>
                                        <td><b>0</b></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr style="background: orangered">
                                        <td><b>Total Aktiva</b></td>
                                        <td>0</td>
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
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Hutang Afiliasi - Fedora</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Hutang Dagang - IDR</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Hutang Pajak - PPh 21</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Hutang Pajak - PPh 23</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Hutang Pajak - PPh 4 (2)</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Hutang PPn Kurang Bayar</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Uang Muka Penjualan - IDR</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Uang Muka Setoran Modal</td>
                                        <td>0</td>
                                    </tr>
                                    <tr style="background: blue">
                                        <td><b>Jumlah Kewajiban Lancar</b></td>
                                        <td><b>0</b></td>
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
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Laba/Rugi ditahan</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Laba/Rugi ditahun berjalan</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Deviden</td>
                                        <td>0</td>
                                    </tr>
                                    <tr style="background: blue">
                                        <td><b>Jumlah Ekuitas</b></td>
                                        <td><b>0</b></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr style="background: orangered">
                                        <td><b>Total Kewajiban dan Ekuitas </b></td>
                                        <td><b>0</b></td>
                                    </tr>


                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('argon') }}/datatable/datatables.min.js" type="text/javascript"></script>
    <script type="text/javascript">


    </script>
@endpush
