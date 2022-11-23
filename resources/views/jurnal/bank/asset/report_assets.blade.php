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
    $(document).ready(function() {
     $('#table_des').DataTable();
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
