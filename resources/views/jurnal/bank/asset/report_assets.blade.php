@extends('layouts.app', ['activePage' => 'Report Assets'])
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
                                <h3 class="mb-0">Report Assets</h3>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="{{ route('export_report_asset') }}" class="form-horizontal" enctype="multipart/form-data">
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
                    <br>
                    <div class="mx-3">
                        <div class="table-responsive">
                            <table id="myTable" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Trans Date</th>
                                        <th scope="col">Barang</th>
                                        <th scope="col">Harga Barang</th>
                                        <th scope="col">More</th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
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
    @include('jurnal.bank.asset.modal.modal_report')
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
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            drawCallback: function(settings) {
                $(".spesifikasi").click(function(e) {
                    $currID = $(this).attr("data-id");
                    $.get("asset_detail_report/" + $currID, function(data) {
                        $('#data_spek').html(data);
                    });
                });
                $(".despresiasi").click(function(e) {
                    $currID = $(this).attr("data-id");
                    $.get("asset_detail_des/" + $currID, function(data) {
                        $('#data_des').html(data);
                    });
                });

            },
            ajax: '{!! route('report_listasset') !!}',
            columns: [{
                    data: 'trans_date',
                    name: 'trans_date'
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'harga_barang',
                    name: 'harga_barang'
                },
                {
                    data: 'More',
                    name: 'More',
                    searchable: false,
                    orderable: false
                },
            ]
        });

    </script>

@endpush
