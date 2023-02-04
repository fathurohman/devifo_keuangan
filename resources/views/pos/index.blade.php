@extends('layouts.app', ['activePage' => 'pos'])
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
                                <h3 class="mb-0">Order</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('create.order') }}" class="btn btn-sm btn-primary">Add Data</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                    </div>
                    <div class="mx-3">
                        <div class="table-responsive">
                            <table id="myTable" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Created</th>
                                        <th scope="col">Kode Nota</th>
                                        <th scope="col">Nama Pembeli</th>
                                        {{-- <th scope="col">Created By</th> --}}
                                        <th scope="col">Status</th>
                                        <th scope="col">More</th>

                                    </tr>
                                </thead>
                                <tbody>
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
    @include('pos.modal.modal_details')
@endsection
@push('js')
    <script src="{{ asset('argon') }}/datatable/datatables.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            drawCallback: function(settings) {
                $(".details").click(function(e) {
                    $currID = $(this).attr("data-id");
                    $.get("detail_order/" + $currID, function(data) {
                        $('#data_details').html(data);
                    });
                })

            //     $(".child").click(function(e) {
            //         $currID = $(this).attr("data-id");
            //         $.get("jurnal_bank_child/" + $currID, function(data) {
            //             $('#data_child').html(data);
            //         });
            //     });

             },
            ajax: '{!! route('listorder.order') !!}',
            columns: [{
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'kode_nota',
                    name: 'kode_nota'
                },
                {
                    data: 'nama_pembeli',
                    name: 'nama_pembeli'
                },
                // {
                //     data: 'created_by',
                //     name: 'created_by'
                // },
                {
                    data: 'Status',
                    name: 'Status',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'More',
                    name: 'More',
                    searchable: false,
                    orderable: false
                },
            ]
        });

        $('#tablechild').DataTable({
            processing: true,
            serverSide: true,

        });

    </script>
@endpush
