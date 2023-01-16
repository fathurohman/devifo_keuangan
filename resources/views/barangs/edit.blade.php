@extends('layouts.app', ['activePage' => 'barangs'])
@section('content')
    @include('users.partials.header', [ 'class' => 'col-lg-7',
])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Add Barang') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('barangs.update',$data->id) }}" autocomplete="off">
                        @csrf
                        @method('PUT')
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
                                <div class="form-group{{ $errors->has('Kode Barang') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-kode Barang">{{ __('kode Barang') }}</label>
                                    <input type="text" name="kode_barang" id="input-kode Barang"
                                        class="form-control form-control-alternative{{ $errors->has('kode Barang') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('kode Barang') }}" value="{{$data->kode_barang}}" required>
                                    @if ($errors->has('kode Barang'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('kode Barang') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('Nama Barang') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-nama_barang">{{ __('Nama Barang') }}</label>
                                    <input type="text" name="nama_barang" id="input-nama_barang" class="form-control form-control-alternative{{ $errors->has('Nama Barang') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Nama Barang') }}" value="{{$data->nama_barang}}" required>                                    @if ($errors->has('Nama Barang'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('Nama Barang') }}</strong>
                                            </span> @endif
                                </div>
                                <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-stock">{{ __('stock') }}</label>
                                    <input type="number" name="stock" id="input-stock"
                                        class="form-control form-control-alternative{{ $errors->has('stock') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('stock') }}" value="{{$data->stock}}" required>
                                    @if ($errors->has('stock'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('stock') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            <a href="{{ route('barangs.index') }}" type="button" class="btn btn-info mt-4">{{ __('Back') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('layouts.footers.auth')
@endsection
