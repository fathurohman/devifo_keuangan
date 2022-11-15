@extends('layouts.app', ['activePage' => 'Asset'])
@push('css')
    <link href="{{ asset('argon') }}/datatable/datatables.min.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/css/dt.css" rel="stylesheet">
@endpush
@section('content')
    @include('users.partials.header', [
        'class' => 'col-lg-7',
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Add Asset penyusutan') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('store_penyusutan') }}" autocomplete="off" id="form-order">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('Fill this form') }}</h6>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('coa') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-status_coa">{{ __('coa') }}</label>
                                        <select name="coa_id" id="coa_id"
                                            class="form-control form-control-alternative{{ $errors->has('status_coa') ? ' is-invalid' : '' }}"
                                            aria-label="status_coa:" required>
                                            <option value="" selected>Open this select menu</option>
                                            <option value="90">Biaya Dibayar Dimuka - Fasilitas Gedung</option>
                                            <option value="109">Aktiva Jakarta - Peralatan Kerja</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-Date">{{ __('Date') }}</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input id="Date" name="Date" class="form-control datepicker"
                                                placeholder="Select date" type="text">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                {{-- <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('id_barang') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('id_barang') }}</label>
                                        <input type="text" name="id_barang" id="input-id_barang"
                                            class="form-control form-control-alternative{{ $errors->has('id_barang') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('id_barang') }}"  readonly>
                                        @if ($errors->has('id_barang'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('id_barang') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-coa">{{ __('Barang') }}</label>
                                    <div class="input-group">
                                        <input id="name_barang" name="name_barang" type="text" class="form-control" placeholder="nama barang"
                                            aria-label="coa" aria-describedby="basic-addon2" readonly>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#barangList">
                                                Find
                                            </button>
                                        </div>
                                        <input name="id_barang" id="id_barang" hidden>
                                    </div>

                                </div>
                            </div>



                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-amount">{{ __('amount') }}</label>
                                        <input type="text" id="input-amount"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('amount') }}" required>
                                        <input type="text" name="amount" id="input-amount-real"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('amount') }}" hidden>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-total">{{ __('Total') }}</label>
                                        <input type="text" id="input-total"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('total') }}" name="total" readonly>
                                        {{-- <input type="text" id="input-total-real"
                                            class="form-control form-control-alternative" hidden> --}}
                                    </div>
                                </div>

                            </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label class="form-control-label" for="input-memo">{{ __('memo') }}</label>
                                        <textarea name="memo" class="form-control" id="memo" rows="3" placeholder="Catatan tambahan..."></textarea>
                                    </div>
                                </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                <a href="#" type="button" class="btn btn-info mt-4">{{ __('Back') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('jurnal.bank.asset.nama_baranglist')
    @include('layouts.footers.auth')
@endsection
@push('js')
    <script src="/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('argon') }}/datatable/datatables.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('argon/js/bank.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('tbody').on('focus', ".autosuggest", function() {
                var tr = $(this).parent().parent();
                // console.log(tipeatk);
                $(this).autocomplete({
                    source: "{{ URL('coa/autocomplete') }}",
                    // source: "{{ URL('search/autocompletenama') }}",
                    minLength: 1,
                    select: function(event, ui) {
                        // tr.find('.qty').val("");
                        // $('#selectnip').val(ui.item.value);
                        tr.find('.account_no').val(ui.item.kode);
                        tr.find('.autosuggest').val(ui.item.value);
                        tr.find('.account_id').val(ui.item.id);
                    }
                })
            })
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#barang').DataTable({
                processing: true,
                serverSide: true,
                drawCallback: function(settings) {
                    $('.pilihbarang').click(function() {
                        $currID = $(this).attr("data-id");
                        $('#input-id_barang').val('');
                        $('#name_barang').val('');
                        $('#id_barang').val('');
                        // alert($currID);
                        $.get('/data_barang?pid=' + $currID, function(data) {
                            $('#input-id_barang').val(data.id);
                            $('#name_barang').val(data.nama_barang);
                            $('#id_barang').val(data.id);


                        });
                        $('#barangList').modal('toggle');
                        // $('#coa-field').val($currID);
                    });
                },
                ajax: '{!! route('listnamabarang') !!}',
                columns: [{
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'Action',
                        name: 'Action',
                        searchable: false,
                        orderable: false
                    },
                ]
            });
        });
    </script>
@endpush
