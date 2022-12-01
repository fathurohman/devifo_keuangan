@extends('layouts.app', ['activePage' => 'Neraca'])
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
                                <h3 class="mb-0">Neraca</h3>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="{{ route('export_neraca') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 mb-5">
                                <div class="card shadow">
                                    <div class="card-header border-0">
                                        <label for="inputState">Bulan Awal</label>
                                        <select id="start_month_id" name="start_month" class="form-control" required>
                                            <option selected disabled value="">Pilih Bulan...</option>
                                            @foreach ($month_list as $key => $m)
                                                <option value="{{ $key }}">{{ $m }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" value="{{ auth()->user()->id }}" id="sales_id" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 mb-5">
                                <div class="card shadow">
                                    <div class="card-header border-0">
                                        <div class="card-header border-0">
                                            <label for="inputState">Bulan Awal</label>
                                            <select id="end_month_id" name="end_month" class="form-control" required>
                                                <option selected disabled value="">Pilih Bulan...</option>
                                                @foreach ($month_list as $key => $m)
                                                    <option value="{{ $key }}">{{ $m }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" value="{{ auth()->user()->id }}" id="sales_id" hidden>
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
                    <div class="col-12">
                    </div>
                    <div class="mx-3">
                        <div class="table-responsive">
                            <div id="table-neraca"></div>
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

        function neraca(from, to) {
            $.ajax({
                url: "{{ route('neraca_json') }}",
                method: "GET",
                dataType: "json",
                data: {
                    from: from,
                    to: to

                },
                success: function(data) {
                    $('#table-neraca').html(data.html);
                }
            });
        }
        $("#start_month_id").change(function() {
            var from = $('#start_month_id').val();
            var to = $('#end_month_id').val();

            neraca(from, to);
        });
        $("#end_month_id").change(function() {
            var from = $('#start_month_id').val();
            var to = $('#end_month_id').val();

            neraca(from, to);
        });
    </script>
@endpush
