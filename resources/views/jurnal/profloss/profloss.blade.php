@extends('layouts.app', ['activePage' => 'Profitloss'])
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
                                <h3 class="mb-0">ProfitLoss</h3>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="{{ route('export_profitloss') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-xl-6 mb-5 mb-xl-0">
                            <div class="card shadow">
                                <div class="card-header border-0">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control datepicker" id="start" name="start" placeholder="Start From"
                                                type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5 mb-xl-0">
                            <div class="card shadow">
                                <div class="card-header border-0">
                                    <div class="form-group">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control datepicker" id="end" name="end" placeholder="Until date"
                                                type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="ml-3 mt-2 mb-2 col-lg-6 col-md-6 col-sm-6">
                            <button type="submit" class="btn btn-primary">{{ __('Export Excel') }}</button>
                        </div>
                    </div>
                    </form>

                    <div class="mx-3">
                        <div class="table-responsive">
                            {{-- <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col"> </th>
                                        <th scope="col">Sum</th>
                                    </tr>
                                </thead>
                                <tbody style="color: black">
                                    <tr>
                                        <td>{{$penjualan['Nama']}}</td>
                                        <td>{{number_format((float) $penjualan['total_penjualan'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$hapok['Nama']}}</td>
                                        <td>{{number_format((float) $hapok['total_hapok'], 2, '.', ',') }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$potong_beli['Nama']}}</td>
                                        <td>{{number_format((float) $potong_beli['total_pot_beli'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr style="background-color: #96D2D9">
                                        <td><b>LABA KOTOR</b></td>
                                        <td><b>{{number_format((float) $laba_kotor, 2, '.', ',')}}</b></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td>Beban Operasi</td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td>{{$badumum_atk['Nama']}}</td>
                                        <td>{{number_format((float) $badumum_atk['total_atk'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$badmumum_bp_pph21['Nama']}}</td>
                                        <td>{{number_format((float) $badmumum_bp_pph21['total_bp_pph21'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$badmumum_bp_pph23['Nama']}}</td>
                                        <td>{{number_format((float) $badmumum_bp_pph23['total_bp_pph23'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$badmumum_bp_pph4['Nama']}}</td>
                                        <td>{{number_format((float) $badmumum_bp_pph4['total_bp_pph4'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$badmumum_dapur['Nama']}}</td>
                                        <td>{{number_format((float) $badmumum_dapur['total_dapur'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$badmumum_la['Nama']}}</td>
                                        <td>{{number_format((float) $badmumum_la['total_la'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$badmumum_materai['Nama']}}</td>
                                        <td>{{number_format((float) $badmumum_materai['total_materai'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$badmumum_pencetakan['Nama']}}</td>
                                        <td>{{number_format((float) $badmumum_pencetakan['total_pencetakan'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$badmumum_jaspro['Nama']}}</td>
                                        <td>{{number_format((float) $badmumum_jaspro['total_jaspro'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$badmumum_manfee['Nama']}}</td>
                                        <td>{{number_format((float) $badmumum_manfee['total_manfee'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$badmumum_ppbd['Nama']}}</td>
                                        <td>{{number_format((float) $badmumum_ppbd['total_ppbd'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$badmumum_tagin['Nama']}}</td>
                                        <td>{{number_format((float) $badmumum_tagin['total_tagin'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$badmumum_tagtel['Nama']}}</td>
                                        <td>{{number_format((float) $badmumum_tagtel['total_tagtel'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$badmumum_transportasi['Nama']}}</td>
                                        <td>{{number_format((float) $badmumum_transportasi['total_transportasi'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$bdd__bp_pph23['Nama']}}</td>
                                        <td>{{number_format((float) $bdd__bp_pph23['total_bdd__bp_pph23'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$bp_sewken['Nama']}}</td>
                                        <td>{{number_format((float) $bp_sewken['total_bp_sewken'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$bp_perker['Nama']}}</td>
                                        <td>{{number_format((float) $bp_perker['total_bp_perker'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$bab['Nama']}}</td>
                                        <td>{{number_format((float) $bab['total_bab'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$bgu['Nama']}}</td>
                                        <td>{{number_format((float) $bgu['total_bgu'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$bll['Nama']}}</td>
                                        <td>{{number_format((float) $bll['total_bll'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$bpp_pk['Nama']}}</td>
                                        <td>{{number_format((float) $bpp_pk['total_bpp_pk'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$bppn1['Nama']}}</td>
                                        <td>{{number_format((float) $bppn1['total_bppn1'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$btl['Nama']}}</td>
                                        <td>{{number_format((float) $btl['total_btl'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$lskl['Nama']}}</td>
                                        <td>{{number_format((float) $lskl['total_lskl'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr style="background: #96D2D9">
                                        <td><b>Jumlah Beban Operasi</b></td>
                                        <td><b>{{number_format((float) $jumlah_beban_operasi, 2, '.', ',')}}</b></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td><b>Pendapatan Lain"</b></td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td>{{$pll['Nama']}}</td>
                                        <td>{{number_format((float) $pll['total_pll'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$pbb['Nama']}}</td>
                                        <td>{{number_format((float) $pbb['total_pbb'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr style="background: #96D2D9">
                                        <td><b>Jumlah Pendapatan Lain" </b></td>
                                        <td><b>{{number_format((float) $jumlah_pendapatan_lain, 2, '.', ',')}}</b></td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td><b>Laba/Rugi</b></td>
                                        <td>{{number_format((float) $laba_rugi, 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>Pembagian Laba :</td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td>  Ibu Fedora 30%</td>
                                        <td>{{number_format((float) $fedora_30persen, 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>  Bp Dicky 70%</td>
                                        <td>{{number_format((float) $dicky_70persen, 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td>SALES</td>
                                        <td>{{number_format((float) $penjualan['total_penjualan'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>HPP</td>
                                        <td>{{number_format((float) $hapok['total_hapok'], 2, '.', ',') }}</td>
                                    </tr>
                                    <tr>
                                        <td>LABA KOTOR</td>
                                        <td>{{number_format((float) $potong_beli['total_pot_beli'], 2, '.', ',')}}</td>
                                    </tr>

                                    <tr>
                                        <td>Wages and Salaries</td>
                                        <td>{{number_format((float) $wages_and_salaries, 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>Rent,Insurance,Manintenance Expense</td>
                                        <td>{{number_format((float) $rime, 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>General & Administration Expenses</td>
                                        <td>{{number_format((float) $gae, 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td>Depreciation Aset Expense</td>
                                        <td>{{number_format((float) $bpp_pk['total_bpp_pk'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                    <tr>
                                        <td> Interest Income</td>
                                        <td> {{number_format((float) $pll['total_pll'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td> Rental Income</td>
                                        <td> - </td>
                                    </tr>
                                    <tr>
                                        <td> Other expense</td>
                                        <td>{{number_format((float) $bab['total_bab'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td> Income Taxes</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td> Payroll Taxes 21</td>
                                        <td>{{number_format((float) $badmumum_bp_pph21['total_bp_pph21'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td> Other Taxes- 23</td>
                                        <td>{{number_format((float) $badmumum_bp_pph23['total_bp_pph23'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td> Other Taxes- 4(2) & UMKM Final </td>
                                        <td>{{number_format((float) $badmumum_bp_pph4['total_bp_pph4'], 2, '.', ',')}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr style="background: yellow">
                                        <td><b>Profit and loss</b></td>
                                        <td><b>{{number_format((float) $profit_loss, 2, '.', ',')}}</b></td>
                                    </tr>
                                    </tr>
                                </tbody>
                            </table> --}}
                            <div id="table-prof"></div>
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
    <script src="/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
    $(".datepicker").datepicker({
            format: "yyyy-mm-dd",
            // startView: "months",
            // minViewMode: "months"
        });
        function narik(from, to) {
            $.ajax({
                url: "{{ route('prof_loss_json') }}",
                method: "GET",
                dataType: "json",
                data: {
                    from: from,
                    to: to

                },
                success: function(data) {
                    $('#table-prof').html(data.html);
                    console.log(data);
                }
            });
        }
        $("#start").change(function() {
            var from = $('#start').val();
            var to = $('#end').val();

            narik(from, to);
        });
        $("#end").change(function() {
            var from = $('#start').val();
            var to = $('#end').val();

            narik(from, to);
        });
    </script>

@endpush
