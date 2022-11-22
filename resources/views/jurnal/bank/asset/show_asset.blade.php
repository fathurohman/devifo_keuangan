@extends('layouts.app', ['activePage' => 'Asset'])
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
                                <h3 class="mb-0">Asset</h3>
                            </div>
                            {{-- <div class="col-4 text-right">
                                <a href="{{ route('create_asset_penyusutan') }}" class="btn btn-sm btn-primary">Add Data Penyusutan</a>
                            </div> --}}
                            {{-- <div class="col-4 text-right">
                                <a href="{{ route('create_asset') }}" class="btn btn-sm btn-primary">Add Data</a>
                            </div> --}}
                        </div>
                    </div>

                    <div class="col-12">
                    </div>
                    <div class="mx-3">
                        <div class="table-responsive">
                            <table id="myTable" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Trans Date</th>
                                        <th scope="col">Inv No</th>
                                        <th scope="col">Barang</th>
                                        <th scope="col">COA</th>
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
    @include('jurnal.bank.asset.modal.modal_asset')
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
                    $.get("asset_detail/" + $currID, function(data) {
                        $('#data_details').html(data);
                    });
                });

            },
            ajax: '{!! route('listasset') !!}',
            columns: [{
                    data: 'trans_date',
                    name: 'trans_date'
                },
                {
                    data: 'trans_no',
                    name: 'trans_no'
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'coa',
                    name: 'coa'
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
