@extends('layouts.app', ['activePage' => 'bahan baku'])
@section('content')
    @include('users.partials.header', [ 'class' => 'col-lg-7',
])
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Add Bahan Baku') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('bahan_baku.update',$data->id) }}" autocomplete="off">
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
                                <div class="form-group{{ $errors->has('Nama Bahan Baku') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-Nama Bahan Baku">{{ __('Nama Bahan Baku') }}</label>
                                    <input type="text" name="nama_bahan" id="input-Nama Bahan Baku"
                                        class="form-control form-control-alternative{{ $errors->has('Nama Bahan Baku') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Nama Bahan Baku') }}" value="{{ $data->nama_bahan}}" required>
                                    @if ($errors->has('Nama Bahan Baku'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('Nama Bahan Baku') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-stock">{{ __('stock') }}</label>
                                    <input type="number" name="stock" id="input-stock"
                                        class="form-control form-control-alternative{{ $errors->has('stock') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('stock') }}" value="{{ $data->stock}}" required>
                                    @if ($errors->has('stock'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('stock') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-satuan">{{ __('satuan') }}</label>
                                    <select name="satuan" class="form-control form-control-alternative" required>
                                        <option value="{{ $data->satuan }}" selected>{{ $data->satuan }}</option>
                                        <option value="kg">kg</option>
                                        <option value="liter">liter</option>
                                        <option value="rim">rim</option>
                                    </select>
                                    {{-- <input type="number" name="satuan" id="input-satuan"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('satuan') }}" required> --}}

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
