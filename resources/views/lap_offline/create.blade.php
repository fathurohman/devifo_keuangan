@extends('layouts.app', ['activePage' => 'create laporan offline'])
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
                            <h3 class="mb-0">{{ __('Add Laporan Offline') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('lap_off.store') }}" enctype="multipart/form-data" autocomplete="off" id="form-order">
                            @csrf

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
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-name">{{ __('name') }}</label>
                                        <input type="text" name="name" id="input-name"
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-control-label" for="input-keterangan">{{ __('keterangan') }}</label>
                                    <textarea name="keterangan" class="form-control" id="keterangan" rows="2" placeholder="..."></textarea>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-debit">{{ __('Debit') }}</label>
                                        <input type="text" id="input-debit"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('0') }}" >
                                        <input type="text" name="debit" id="input-debit-real"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('debit') }}" value="0" hidden>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-credit">{{ __('Credit') }}</label>
                                        <input type="text" id="input-credit"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('0') }}">
                                        <input type="text" name="credit" id="input-credit-real"
                                            class="form-control form-control-alternative"
                                            placeholder="{{ __('credit') }}" value="0" hidden>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-foto">{{ __('Upload Nota') }}</label>
                                        <input name="nota" type="file" class="form-control form-control-alternative"
                                            id="customFile"><br>
                                            <small>*kosongkan jika tidak ada nota</small>
                                    </div>
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
    @include('layouts.footers.auth')
@endsection
@push('js')
    <script src="/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('argon') }}/datatable/datatables.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('argon/js/bank.js') }}"></script>

@endpush
