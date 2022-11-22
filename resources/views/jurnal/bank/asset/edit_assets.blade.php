@extends('layouts.app', ['activePage' => 'edit Assets'])

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
                            <h3 class="mb-0">{{ __('Update Assets') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('update.asset', $data->id) }}" autocomplete="off">
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
                                    <div class="form-group{{ $errors->has('details') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-details">{{ __('details') }}</label>
                                        <textarea name="details" class="form-control" id="area1" rows="3" placeholder="details..." required>{{ $data->details }}</textarea>
                                        @if ($errors->has('details'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('details') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('penggunaan') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-penggunaan">{{ __('penggunaan') }}</label>
                                        <textarea name="penggunaan" class="form-control" id="area1" rows="3" placeholder="penggunaan..." required>{{ $data->penggunaan }}</textarea>
                                        @if ($errors->has('penggunaan'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('penggunaan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                <a href="{{ route('asset') }}" type="button"
                                    class="btn btn-info mt-4">{{ __('Back') }}</a>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
    </div>
@endsection
